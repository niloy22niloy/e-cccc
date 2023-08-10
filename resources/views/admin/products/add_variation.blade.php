@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Add Variation</li>
                    {{-- <li class="breadcrumb-item active">{{$name}}</li> --}}
                </ol>
                <div class="row">
                    <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
                <h3>Colors List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center">
                   <tr>
                    <th>Serial</th>
                    <th>Color Name</th>
                    <th>Color Code</th>
                    <th>Action</th>
                   </tr>

                @foreach ($color as $key=>$colo)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><span class="badge rounded-pill bg-red" style="background: {{$colo->color_code}};">{{$colo->color_name}}</span></td>
                    <td>
                        @if($colo->color_code == null)
                        It Has No Color
                        @else
                        <div class="m-auto" style="width:50px;height:50px;background:{{$colo->color_code}}"></div>
                        @endif
                    </td>
                    <td>
                        <a href="" class="btn btn-primary">Edit</a>
                        <a href="" class="btn btn-danger">Delete</a>
                    </td>

                </tr>
                @endforeach
            </table>

            </div>
          </div>
                    </div>
             <div class="col-lg-4">
                  <div class="card">
                      <div class="card-header">
               <h3>Add Color</h3>


                      </div>
                    <div class="card-body">
                        <form action="{{route('add.color')}}" method="POST">
                            @csrf

                     <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="text" name="color_name" class="form-control" value="">
                     </div>
                     <div class="mb-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="text" name="color_code" class="form-control" value="">
                     </div>

                     <div class="mb-3 mx-auto">

                        <button type="submit" class="btn  btn-primary" style="width:370px;">Add Color</button>
                  </div>
                    </div>
                </form>


                  </div>
             </div>

                </div>
                <div class="row mt-3">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>Sizes List</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped text-center">
                                   <tr>
                                    <th>Serial</th>
                                    <th>Size Name</th>

                                    <th>Action</th>
                                   </tr>

                                @foreach ($sizes as $key=>$size)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><span class="badge rounded-pill bg-primary">{{$size->size_name}}</span></td>
                                    <td>
                                        <a href="" class="btn btn-primary">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                                @endforeach
                            </table>

                            </div>
                    </div>
                </div>
                    <div class="col-lg-4">
                      <div class="card">
                        <div class="card-header">
                            <h3>Add Size</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('add.sizes')}}" method="POST">
                                @csrf
                           <div class="mb-3">
                            <label for="" class="form-label">Add Sizes</label>
                            <input type="text" name="sizes" class="form-control">
                           </div>
                           <div class="mb-3">

                            <button type="submit" class="btn  btn-primary" style="width:365px;">Add Sizes</button>
                           </div>
                        </form>
                        </div>
                      </div>
                    </div>
                </div>




<script>
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>






@endsection

<style> #toast-container > .toast-error{ background-color: #BD362F; } </style>

