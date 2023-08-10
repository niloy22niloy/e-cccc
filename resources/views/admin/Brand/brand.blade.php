@extends('admin.admin_asset')
@section('content')
<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item ">Top Banner</li>
                </ol>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                               <h3>List OF Top-Banner</h3> 
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered text-center">
                                    <tr>
                                        <th>Serial</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse($brands as $key=>$top_banner)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <img src="{{asset('Brand_name/'.$top_banner->brand_images)}}" class="img-fluid" style="width:150px;height:150px;" alt="">
                                        </td>
                                        <td>
                                           @if($top_banner->status == 1)
                                           <span class="badge rounded-pill bg-primary">Status On</span>
                                           @elseif($top_banner->status == 0)
                                           <span class="badge rounded-pill bg-danger">Status Off</span>
                                           @elseif($top_banner->status == null)
                                           <span class="badge rounded-pill bg-warning">Not Set Yet</span>
                                           @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                  Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a class="dropdown-item" href="#">Action</a></li>
                                                  @if($top_banner->status == 1)
                                                  <li><a class="dropdown-item" href="">Turn Off</a></li>
                                                  @elseif($top_banner->status == 0 || $top_banner->status == null)
                                                  <li><a class="dropdown-item" href="">Turn On</a></li>
                                                 
                                           @endif
                                                  <li><a class="dropdown-item" href="#">delete</a></li>
                                                  
                                                </ul>
                                              </div>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add Brand</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                               
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Add Brand Name</label>
                                    <input type="file" name="brand_name" id="brand_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <div id="image_preview" style="border: 2px dashed #ccc; width: 180px; height: 150px; display: flex; justify-content: center; align-items: center;">
                                        <!-- Placeholder content or default box -->
                                        <span style="color: #ccc;text-align:center;">Image Banner</span>
                                </div>
                                </div>
                                <div class="mb-3">
                                    
                                    <select id="status" name="status" class="form-control">
                                        <option>Select Status</option>
                                        <option value="1">On</option>
                                        <option value="0">Off</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Add Banner</button>
                                </div>
                            </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            
    </div>
    
</main>
</div>
<script>
    document.getElementById('brand_name').addEventListener('change', function() {
        // Get the file input element
        const fileInput = this;

        // Get the div element for image preview
        const imagePreview = document.getElementById('image_preview');

        // Check if a file is selected
        if (fileInput.files && fileInput.files[0]) {
            // Create a new FileReader
            const reader = new FileReader();

            // Set up the reader to load the selected file as a data URL
            reader.readAsDataURL(fileInput.files[0]);

            // When the file is loaded, show the image preview
            reader.onload = function(event) {
                // Create an image element
                const imageElement = document.createElement('img');

                // Set the src attribute to the data URL
                imageElement.src = event.target.result;

                // Set some CSS styles for the image preview
                imageElement.style.width = '180px';
            imageElement.style.height = '150px'; // Adjust the height as needed

                // Remove any previously displayed image
                while (imagePreview.firstChild) {
                    imagePreview.removeChild(imagePreview.firstChild);
                }

                // Append the image element to the image preview div
                imagePreview.appendChild(imageElement);
            };
        } else {
            // If no file is selected, remove any previously displayed image
            while (imagePreview.firstChild) {
                imagePreview.removeChild(imagePreview.firstChild);
            }
        }
    });
</script>

@if(session('success'))
<script>
    $(document).ready(function () {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
        });
    });
</script>
@endif


@endsection