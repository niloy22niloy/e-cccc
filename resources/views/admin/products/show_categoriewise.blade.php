@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Categories Products</li>
                </ol>
<div class="row">
    <div class="col-lg-10 m-auto col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3>Category-Wise Products</h3>
            </div>
            <div class="card-body">
   <table class="table table table-striped text-center" id="datatablesSimple">

    <thead class="text-center">
  <tr>
    <th>Serial</th>
    <th>Category Name</th>
    <th>Total Products</th>
    <th>Action</th>

  </tr>
</thead >
<tfoot class="text-center">
    <tr>
        <th>Serial</th>
        <th>Category Name</th>
        <th>Total Products</th>
        <th>Action</th>

      </tr>
</tfoot>
@foreach ($categories as $key=>$category)
<tr>
    <td>{{$key+1}}</td>
    <td>{{$category->category_name}}</td>
    <td>
      <?php
       $total_products_count =  App\Models\ProductsModel::where('category_id',$category->id)->get();
       echo count($total_products_count);
        ?>
    </td>
    <td>
        <a href="{{route('categorywise.products',$category->id)}}" class="btn btn-primary">Show Products</a>
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


@endsection

<style> #toast-container > .toast-error{ background-color: #BD362F; } </style>
<style>
#datatablesSimple thead,
#datatablesSimple th {text-align: center;}
</style>

