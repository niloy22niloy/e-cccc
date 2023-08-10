@extends('admin.admin_asset')
@section('content')

<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Add Inventory</li>
                    <li class="breadcrumb-item active">{{$name}}</li>
                </ol>
                <div class="row ">
                    <div class="col-lg-4 m-auto">


                        <div class="card">
                            <div class="card-header">
                     <h3>Add Inventory</h3>


                            </div>
                          <div class="card-body">
                              <form action="{{route('add.inventory_store')}}" method="POST">
                                  @csrf

                           <div class="mb-3">
                              <label for="" class="form-label">Product Name</label>
                              <input type="number" name="product_id" value="{{$id}}" hidden>
                              <input type="text" class="form-control" value="{{$name}}" readonly>
                           </div>
                           <div class="mb-3">
                              <label for="" class="form-label">Select Color</label>
                                 <select name="color_id" class="form-control" id="">
                                  <option value="">--Select Color----</option>
                                  @foreach ($colors as $color)
                                  <option value="{{$color->id}}">{{$color->color_name}}</option>
                                  @endforeach
                                 </select>
                           </div>
                           <div class="mb-3">
                              <label for="" class="form-label">Select Size</label>
                                 <select name="size_id" class="form-control" id="">
                                  <option value="">--Select Size----</option>
                                  @foreach ($sizes as $size)
                                  <option value="{{$size->id}}">{{$size->size_name}}</option>
                                  @endforeach
                                 </select>
                                 </select>
                           </div>
                           <div class="mb-3">

                                 <input type="number" name="quantity" placeholder="quantity" class="form-control">
                           </div>
                           <div class="mb-3 mx-auto">

                              <button type="submit" class="btn  btn-primary" style="width:370px;">Insert</button>
                        </div>
                      </form>
                          </div>


                        </div>
                   </div>
                   
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12">
                         <div class="card">
                            <div class="card-header">
                                <h3>Inventory List</h3>
                            </div>
                         <div class="card-body">
                                <table class="table table-striped text-center">
                                      <tr>
                                        <th>Serial</th>
                                        <th>Product_Name</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                      </tr>
                                      @foreach ($inventories as $key=>$inventory)
                                          <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <?php
                                                   $product_name =  App\Models\ProductsModel::find($id);
                                                   echo $product_name->product_name;
                                                    ?>
                                            </td>
                                            <td>
                                                @if($inventory->color_id == 1)
                                                No Color has been given
                                                @else
                                                <div class="m-auto" style="width:40px;height:40px;background:{{$inventory->rel_to_color->color_code}};">{{$inventory->rel_to_color->color_name}}</div>
                                                @endif
                                            </td>
                                            <td>
                                                {{$inventory->rel_to_size->size_name}}
                                            </td>
                                            <td>{{$inventory->quantity}}</td>
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

                </div>




<script>
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
$('.category_id').change(function(){
     var category_id=$(this).val();

     $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

     $.ajax({
        type:'POST',
        url:'/getSubcategory',
       data:{'category_id':category_id},
       success:function(data){
        $('#subcategory').html(data);
       }




})

});
$(document).ready(function() {
  $('#summernote').summernote({
    placeholder: 'Enter Product Details',
      tabsize: 2,
      height: 400
  });
});


</script>





@endsection

<style> #toast-container > .toast-error{ background-color: #BD362F; } </style>

