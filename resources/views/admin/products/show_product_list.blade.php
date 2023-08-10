@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Show Products List</li>
                </ol>
<div class="row">
    <div class="col-lg-10 m-auto col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header">

                <h3>Category : <span class="badge bg-primary"><?php
                    $category_name = App\Models\CategoryModel::find($id);
                    echo $category_name->category_name;
                    ?></span> Products</h3>
            </div>
            <div class="card-body">
   <table class="table table table-striped text-center" id="datatablesSimple">

    <thead class="text-center">
  <tr>
    <th>Serial</th>
    <th>Product Name</th>
    <th>Created_At</th>
    <th>Featured_Product</th>
    <th>Action</th>

  </tr>
</thead >
<tfoot class="text-center">
    <tr>
        <th>Serial</th>
        <th>Product Name</th>
        <th>Created_At</th>
        <th>Featured_Product</th>
        <th>Action</th>

      </tr>
</tfoot>
@foreach ($show_product_list as $key=>$show)
<tr>
    <td>{{$key+1}}</td>
    <td>{{$show->product_name}}</td>
      <td>{{$show->created_at->format('d-M-Y')}}</td>
      <td>
        @if($show->featured_product == 1)
        <span class="badge rounded-pill bg-primary">Featured Product</span>  
        @elseif($show->featured_product == 0 || $show->featured_product==null)
        <span class="badge rounded-pill bg-danger">Not Featured Product</span>  
        @endif
      </td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Action
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a href="{{route('show.the.product',[$show->product_name,$show->id])}}" class="dropdown-item">Show This Product</a></li>
              <li><a href="{{route('add.inventory',[$show->product_name,$show->id])}}" class="dropdown-item">Add Inverntory</a></li>
              @if($show->featured_product == 0 || $show->featured_product==null)
              <li><a href="{{route('add.featured',$show->id)}}" class="dropdown-item">Add Featured Product</a></li>
              @elseif($show->featured_product == 1)
              <li><a href="{{route('remove.featured',$show->id)}}" class="dropdown-item">Remove From Featured Product</a></li>
              @endif
              
              <li><a href="" class="dropdown-item">Delete</a></li>
              <li><a class="dropdown-item" href="#">Separated link</a></li>
            </ul>
          </div>
        {{-- <a href="{{route('show.the.product',[$show->product_name,$show->id])}}" class="btn btn-primary">Show This Product</a>
        <a href="{{route('add.inventory',[$show->product_name,$show->id])}}" class="btn btn-success">Add Inverntory</a>
        <a href="" class="btn btn-danger">Delete</a> --}}
    </td>
</tr>
@endforeach



   </table>
            </div>
        </div>
    </div>

</div>
</form>
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
    $(document).ready(function() {
     $(document).on('click','.delete_category',function(e){
            e.preventDefault();
            let up_id = $(this).data('id');


            let name = $(this).data('name');


            if(confirm('Are You Sure to Delete ' + name + '?' )){
                $.ajax({
            url:"{{ route('category.delete') }}",
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


        $(document).on('click','.update_user_form',function(){
              let id = $(this).data('id');
              let name=$(this).data('name');
              let email=$(this).data('email');



              $('#up_id').val(id);
              $('#up_name').val(name);
              $('#up_email').val(email);
        });
    });
    // $(document).on('click','.update_user',function(e){
    //         e.preventDefault();
    //         let up_id = $('#up_id').val();

    //         let up_name=$('#up_name').val();
    //         let up_image = $('#up_image').val();

    //         let fileInput = $('#up_image')[0].files[0];
    //         // alert(fileInput.name);




    //         // console.log(name+email);
    //         $.ajax({
    //         url:"{{ route('update.user') }}",
    //         method:'post',
    //         data:{up_id:up_id, up_name:up_name, up_image:fileInput},
    //         success:function(res){
    //              if(res.status == 'success'){
    //                 $('#updateModal').modal('hide');
    //                 $('.table').load(location.href+' .table');
    //              }
    //         },error:function(err){
    //             let error = err.responseJSON;
    //             $.each(error.errors,function(index,value){
    //                 $('.errormsg').append('<span class="text-danger">'+value+'</span>'+'<br>')
    //             });
    //         }


    //         });
    //     })
    $(document).on('click', '.update_user', function(e) {
    e.preventDefault();
    let up_id = $('#up_id').val();

    let up_name = $('#up_name').val();
    let up_image = $('#up_image')[0].files[0];
    let formData = new FormData();
    formData.append('up_id', up_id);
    formData.append('up_name', up_name);
    formData.append('up_image', up_image);
    $.ajax({
        url: "{{ route('update.user') }}",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            if (res.status == 'success') {
                $('#updateModal').modal('hide');
                $('.table').load(location.href + ' .table');
            }
            if (res.image_url) {
            $('#category_image').attr('src', res.image_url);
        }
        },
        error: function(err) {
            let error = err.responseJSON;
            $.each(error.errors, function(index, value) {
                $('.errormsg').append('<span class="text-danger">' + value + '</span>' + '<br>')
            });
        }
    });
});
</script>
@if(session('success'))
<script>
    // Wrap the JavaScript code in a function to avoid polluting the global scope
    $(document).ready(function () {
        // Get the success message from the session
        var successMessage = "{{ session('success') }}";

        // Display the success message using SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: successMessage,
        });
    });
</script>
@endif

@endsection

<style> #toast-container > .toast-error{ background-color: #BD362F; } </style>
<style>
#datatablesSimple thead,
#datatablesSimple th {text-align: center;}
</style>


