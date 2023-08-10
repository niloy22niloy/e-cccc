@extends('admin.admin_asset')
@section('content')
<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Add Brand</li>
                    
                </ol>
                <div class="row">
                    <div class="col-lg-8">
                      <div class="card">
                        <div class="card-header">
                            <h3>Brand List</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($brands as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->brand_name}}</td>
                                        <td><img src="{{asset('Brand/'.$item->brand_image)}}" class="img-fluid" style="width: 50px;" alt=""></td>
                                        <td>
                                            <a href="" class="btn btn-primary">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @empty
                                    No data found
                                        
                                    @endforelse
                                   
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                
                                <h3>Add Brand</h3>
                                @if(session('success'))
                                <div class="alert alert-primary" role="alert">
                                    {{session('success')}}
                                  </div>
                                @endif
                                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                            </div>
                            <div class="card-body">
                                <form action="{{route('brand.add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                              
                                <div class="mb-3">
                                    <label for="" class="form-label">enter brand</label>
                                    <input type="text" name="brand_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="brandImage" class="form-label">Enter brand Image</label>
                                    <input type="file" id="brandImage" name="brand_image" class="form-control">
                                    <img id="imagePreview" src="#" alt="Image Preview" style="display: none; width: 100px; max-height: 200px; margin-top:15px;">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Add Brand</button>
                                </div>
                            </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
            <script>
                document.getElementById("brandImage").addEventListener("change", function() {
                    var previewImage = document.getElementById("imagePreview");
                    var fileInput = this;
                    if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.setAttribute("src", e.target.result);
                            previewImage.style.display = "block";
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                });
            </script>
            
@endsection