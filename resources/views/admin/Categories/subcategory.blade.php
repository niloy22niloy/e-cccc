@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Sub-Category</li>
                </ol>

                <div class="row">
                    <div class="col-lg-4 col-sm-4 m-auto mb-3">
                        <div class="card">

                     <div class="card-header">
                        <h3>Sub-Category Insert</h3>
                        @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="text-danger">{{$error}}</div>
     @endforeach
 @endif
 @if($errors->has('category_id'))
    <div class="error">{{ $errors->first('category_id') }}</div>
@endif
                    </div>
                    <div class="card-body">
                        <form action="{{route('subcategory.insert')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="mb-3">

                        <select id="social" name="category_id" class="form-select" aria-label="Default select example">
                            <option selected>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}|{{ $category->category_image }}">{{$category->category_name}}<img src="image source" class="img-fluid rounded-top" alt=""></option>
                            @endforeach

                       </select>



                        </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subcategory Name</label>
                    <input type="text" name="subcategory_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subcategory Image</label>
                    <input type="file" name="subcategory_image" class="form-control">
                    </div>
                    <div class="mb-3">
                       <button type="submit" class="btn btn-success">Insert</button>
                    </div>
                    </form>
                    </div>

                        </div>

                     </div>
                </div>
<div class="row">
    <div class="col-lg-12 col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3>Subcategory List</h3>
            </div>
            <div class="card-body">
   <table class="table table table-striped" id="datatablesSimple">
    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('/deleted/selected/subcategory') }}">Delete All Selected</button>
    <div class="mb-2">
        <input type="checkbox" id="master">Check All
    </div>

    <thead style="text-center">



  <tr>
    <th>Checkbox</th>
    <th>Serial</th>
    <th>Category Name</th>
    <th>Subcategory Name</th>
    <th>Subcategory Image</th>
    <th>Added By</th>
    <th>Created At</th>
    <th>Action</th>
  </tr>
    </thead>
  @foreach ($subcategory as $key=>$sub)
<tr>
    <td><input type="checkbox" class="sub_chk" data-id="{{$sub->id}}"></td>
    <td>{{$key+1}}</td>
    <td>{{$sub->category_name}}
        {{-- @php
            $category_name = app\models\categoryModel::find($sub->category_id);


        @endphp
        {{$category_name->category_name}} --}}
    </td>
    <td>{{$sub->subcategory_name}}</td>
    <td><img src="{{asset('subcategory_images/'.$sub->subcategory_image)}}" alt="" id="category_image" class="img-fluid" style="width:50px;"></td>
     <td>
        {{-- @php
        $added_by = App\Models\User::find($sub->added_by);
        echo $added_by->name;
    @endphp --}}
    <?php
        $user = App\Models\User::where('id', $sub->added_by)->first();
        if ($user) {
         echo $user->name;
          }
 else
  {
    echo $sub->added_by_name ;
    echo "(not-exist)";
   }
        ?>
     </td>
     <td>{{$sub->created_at->format('d-M-Y')}}</td>
     <td>
        <a href="" class="btn btn-sm btn-success">Edit</a>
        <a href="" class="btn btn-sm btn-danger">Delete</a>
     </td>
</tr>
  @endforeach





   </table>
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
        function formatState(state) {
  if (!state.id) {
    return state.text;
  }

  var value = state.id.split("|");
  var categoryId = value[0];
  var categoryImage = "{{ asset('category_images') }}/" + value[1];

  var $state = $(
    '<span><img style="display: inline-block;width:50px;text-align:center;" src="' + categoryImage + '" class="img-fluid rounded-top" alt="" /> ' + state.text + '</span>'
  );

  return $state;
}

$(document).ready(function() {
  $("#social").select2({
    templateResult: formatState
  });
});
      </script>
      <script>
        Swal.fire(
          'Good job!',
          'You clicked the button!',
          'success'
        )

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


         <script type="text/javascript">
            $(document).ready(function () {
                $('#master').on('click', function(e) {
                 if($(this).is(':checked',true))
                 {
                    $(".sub_chk").prop('checked', true);
                 } else {
                    $(".sub_chk").prop('checked',false);
                 }
                })
                $('.delete_all').on('click', function(e) {
                    var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));


            })
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
        })
            });
                </script>

@endsection



