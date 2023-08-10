@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Categories



                    </li>
                </ol>
<div class="row">
    <div class="col-lg-12 m-auto col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3>Trashed Category List</h3>

            </div>
            <div class="card-body">
   <table class="table" id="datatablesSimple">
    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('/deleted/selected') }}">Delete All Selected</button>
   <div class="mb-3 d-flex">
    <div>
        check all
    </div>
   <input type="checkbox" id="master">
</div>


    <thead>

  <tr>

    <th>Check</th>
    <th>Serial</th>
    <th>Category Name</th>
    <th>Category Image</th>
    <th>Added By</th>
    <th>Created At</th>
    <th>Action</th>
  </tr>
</thead>
<tfoot>
    <tr>



        <th>Check</th>
        <th>Serial</th>
        <th>Category Name</th>
        <th>Category Image</th>
        <th>Added By</th>
        <th>Created At</th>
        <th>Action</th>

      </tr>
</tfoot>
@foreach ($data as $key=>$dat)
<tr>
    <td><input type="checkbox" class="sub_chk" data-id="{{$dat->id}}"></td>
    <td>{{$key+1}}</td>
    <td>{{$dat->category_name}}</td>
    <td><img src="{{asset('category_images/'.$dat->category_image)}}" alt="" id="category_image" class="img-fluid" style="width:50px;"></td>
    <td>
        <?php
        $user = App\Models\User::where('id', $dat->added_by)->first();
        if ($user) {
         echo $user->name;
          }
 else
  {
    echo $dat->added_by_name ;
    echo "(not-exist)";
   }
        ?>
    </td>
    <td>{{$dat->created_at->format('d-M-Y')}}</td>
    <td>
        <div class=''>

<div style="margin-right:5px;">

        <a href="" class="btn btn-primary update_user_form" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="{{$dat->id}}" data-name="{{$dat->category_name}}" data-image="{{$dat->category_image}}"><i class="las la-edit"></i></a>


        <a href="" class="btn btn-danger delete_category" data-name='{{$dat->category_name}}' data-id='{{$dat->id}}'><i class="las la-trash"></i></a>


        <a href="{{route('category.restore',$dat->id)}}" class="btn btn-danger"><i class="fa-solid fa-window-restore"></i></a>



    </td>


</tr>


@endforeach


   </table>
            </div>
        </div>
    </div>



    </div>

 </div>
</div>

            </div>


            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Category_id:</label>
                            <input type="text" class="form-control" id="up_id">
                          </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Category_Name:</label>
                        <input type="text" class="form-control" id="up_name">
                      </div>
                      <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Category_Image:</label>
                        <input type="file" class="form-control" id="up_image">
                        {{-- <img src="{{asset('category_images/')}}" id="up_image" alt="" class="img-fluid" style="width:50px;"> --}}
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_user">Send message</button>
                  </div>
                </div>
              </div>
            </div>

        </main>

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



<script>


    </script>
    @if(session('success'))
    <script>
        $(document).ready(function () {

                Swal.fire(
             'Good job!',
             'Successfully Inserted data',
             'success'
    )

        });
    </script>

    @endif
    {{-- <script type="text/javascript">
        $(document).ready(function () {

            $('#master').on('click', function(e) {
             if($(this).is(':checked',true))
             {
                $(".sub_chk").prop('checked', true);
             } else {
                $(".sub_chk").prop('checked',false);
             }
            });

        });
        </script>
        <script>

        </script> --}}
        {{-- <script>
            $('#master').click(function () {
             $('input:checkbox').prop('checked', this.checked);
         });
        </script> --}}
        <script type="text/javascript">
            $(document).ready(function () {
                $('#master').on('click', function(e) {
                 if($(this).is(':checked',true))
                 {
                    $(".sub_chk").prop('checked', true);
                 } else {
                    $(".sub_chk").prop('checked',false);
                 }
                });
                $('.delete_all').on('click', function(e) {
                    var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));

            });


    //         var allVals = [];

    // $(".sub_chk:checked").each(function() {
    //     allVals.push($(this).attr('data-id'));
    // });
    // alert(allVals.join(', ')); // Concatenate array values with commas

    if(allVals.length <=0)
            {
                alert("Please select row.");
            }

            else {
                var check = confirm("Are you sure you want to delete this row?");
                if(check == true){
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'get',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                }
            }
            });
        });
            </script>
            @if(session('success'))
            <script>
                $(document).ready(function () {

                        Swal.fire(
                     'Good job!',
                     'Successfully Inserted data',
                     'success'
            )

                });
            </script>

            @endif

@endsection


<style> #toast-container > .toast-error{ background-color: #BD362F; } </style>

