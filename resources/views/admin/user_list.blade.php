@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">User Lists</li>
                </ol>


                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Users List
                    </div>
                    <div class="card-body">
                        <table class="table" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>


                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($user_list as $users)
                                <tr>

                                    <td>{{$users->name}}
                                    @if  (Auth::user()->name == $users->name)

                                    <span class="badge bg-primary"> Logged In</span>


                                    @endif
                                    </td>
                                    <td>{{$users->email}}</td>
                                    <td>{{$users->created_at->format('d-M-Y') }}</td>
                                    <td>
                                        @if  (Auth::user()->name == $users->name)
                                        <a href="{{route('admin.edit',$users->id)}}" class="btn btn-success"><i class="las la-edit"></i></a>
                                        @else
                                        <a href="{{route('admin.edit',$users->id)}}" class="btn btn-success update_user_form"><i class="las la-edit"></i></a>
                                        <a href="" class="btn btn-danger delete_user" data-name="{{$users->name}}" data-id="{{$users->id}}"><i class="las la-trash"></i></a>
                                        @endif


                                    </td>


                                </tr>
                                @endforeach




                            </tbody>
                        </table>
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



<script>
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
     $(document).on('click','.delete_user',function(e){
            e.preventDefault();
            let up_id = $(this).data('id');

            let name = $(this).data('name');


            if(confirm('Are You Sure to Delete ' + name + '?' )){
                $.ajax({
            url:"{{ route('delete.user') }}",
            method:'post',
            data:{up_id:up_id},
            success:function(res){
                 if(res.status == 'success'){
                   $('.table').load(location.href+' .table');

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

            toastr.error(`Deleted Successfully!`)



                 }
            }


            });
            }



        })
</script>
@endsection

<style> #toast-container > .toast-error{ background-color: #BD362F; } </style>

