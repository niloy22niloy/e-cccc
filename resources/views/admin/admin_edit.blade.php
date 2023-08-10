@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
             <div class="col-lg-6 col-sm-4 m-auto">
                <div class="card">
                    <form action="{{route('admin.edit.confirm',$users_info->id)}}" method="POST">
                        @csrf
                    <div class="card-header">
                        <h3>Edit {{$users_info->name}}</h3>
                    </div>
                    <div class="card-body">
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{$users_info->name}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{$users_info->email}}">
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-success">
            </div>
                    </div>
                </form>
                </div>
             </div>

            </div>

        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>

                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

@if(session('success'))
   <script>
    toastr.options = {
                    "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
            }

            toastr.error(`Updated Successfully!`)
   </script>
   @endif

   @if(session('fail'))
   <script>
    toastr.options = {
                    "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
            }


            toastr.info(`Not Updated Successfully!`)
   </script>
   @endif

@endsection
<style> #toast-container > .toast-error{ background-color: #BD362F; margin-top:50px;} </style>
<style> #toast-container > .toast-info{ background-color: #2fbda8;margin-top:50px;} </style>

