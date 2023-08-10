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
                    <li class="breadcrumb-item active"><?php
                    $category_name = App\Models\CategoryModel::find($product_details->category_id);
                    echo $category_name->category_name;
                    ?></li>
                    <li class="breadcrumb-item active"><?php
                        $subcategory_name = App\Models\Subcategory::find($product_details->subcategory_id);
                        echo $subcategory_name->subcategory_name;
                        ?></li>
                    <li class="breadcrumb-item active">{{$product_details->product_name}}</li>
                </ol>
<div class="row">
    <div class="col-lg-10 m-auto col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header text-center">
              <h3>Product Details : {{$product_details->product_name}}</h3>

            </div>
            <div class="card-body">

           <div class=" text-center">
            <img src="{{asset('Products/product_preview/'.$product_details->preview)}}" alt="" class="img-fluid" style="width:500px;">

           </div>
           <div class="mb-3 text-center">
            <img src="{{asset('Products/product_thumbnail/'.$product_details->thumbnail)}}" alt="" class="img-fluid" style="width:100px;">
           </div>



           <div class="mb-3">
            <h5>Product Name: </h5>
            <label for="" class="form-label">{{$product_details->product_name}}</label>

        </div>
        <div class="mb-3">
            <h5>Product Short Description:</h5>

            <div style="width:630px;">

                <label for="" class="form-label">{{$product_details->short_description}}</label>
            </div>
        </div>
        <div class="">
            <h5>Product Long Description:</h5>

            <div class="mt-4" style="width:630px;">

                <label for="" class="form-label">{!! $product_details->long_description !!}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pricing</h4>
                    </div>
                    <div class="card-body">

        <div class="mb-3">
            <h5>Product Regular Price : {{ $product_details->price }} Tk</h5>
         <hr>
            <h5>Discount : {{ $product_details->discount }}%</h5>
            <hr>
            <h5>After Discount Price : {{ $product_details->after_discount }} Tk</h5>



        </div>
    </div>
    </div>
</div>
    </div>
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


