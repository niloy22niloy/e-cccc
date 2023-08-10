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
                                       
                                        <th>Action</th>
                                    </tr>
                                  @if(isset($middlebanner))
                                   <tr>
                                    <td>{{$middlebanner->id}}</td>
                                    <td><img src="{{asset('Banner/Middle_Banner/'.$middlebanner->middle_banner)}}" style="width:200px;height:100px;" class="img-fluid" alt=""></td>
                                     <td>
                                       <a href="" class="btn btn-primary">Delete</a>
                                     </td>
                                </tr>
                                   @else
                                   No MiddleBanner Added Yet
                                   @endif

                                  
                                 

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add Top Banner</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{route('add.middle_banner')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                               
                                <div class="mb-3">
                                    <label for="top_banner" class="form-label">Add Middle Banner</label>
                                    <input type="file" name="middle_banner" id="top_banner" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <div id="image_preview" style="border: 2px dashed #ccc; width: 300px; height: 200px; display: flex; justify-content: center; align-items: center;">
                                        <!-- Placeholder content or default box -->
                                        <span style="color: #ccc;text-align:center;">Image Banner</span>
                                </div>
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
    document.getElementById('top_banner').addEventListener('change', function() {
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
                imageElement.style.width = '300px';
            imageElement.style.height = '200px'; // Adjust the height as needed

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