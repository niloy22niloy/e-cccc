@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Inventories List List</li>
                </ol>

            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Categorywise (<?php
                                $category_name = App\Models\CategoryModel::find($id);
                                echo $category_name->category_name;

                                ?>) Inventory</h3>
                        </div>
                        <div class="card-body">
                             <table class="table table-striped">
                               <tr>
                                <th>Serial</th>
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Product Color</th>
                                <th>Available Sizes</th>

                               </tr>
                               @forelse ($inventories as $key=>$s)
                               <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <?php
                                        $product_name = App\Models\ProductsModel::find($s->product_id);
                                        echo $product_name->product_name;

                                        ?>
                                </td>
                                <td>
                                     {{$s->quantity}}
                                </td>
                                <td>
                                    <?php
                                    $product_color = App\Models\Color::find($s->color_id);
                                    echo $product_color->color_name;

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $available_sizes = App\Models\Size::find($s->size_id);
                                    echo $available_sizes->size_name;

                                    ?>
                                </td>
                               </tr>
                               @empty
                            <tr class="">
                                <span class="badge bg-primary mb-2">No Data Found</span>
                            </tr>

                            @endforelse

                             </table>
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



