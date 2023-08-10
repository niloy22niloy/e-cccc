@extends('admin.admin_asset')
@section('content')


<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Add Products</li>
                </ol>
                <div class="row">
             <div class="col-lg-12">
                  <div class="card">
                      <div class="card-header">
                        <h3>Add Product</h3>

                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                    @endif
                      </div>


                      <div class="card-body">
                        <form action="{{route('add')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                <select name="category_id" id="" class="form-control category_id">
                                   <option value="">---Select Category---</option>
                                   @foreach ($categories as $category)
                                   <option value="{{$category->id}}">{{$category->category_name}}</option>

                                   @endforeach

                                </select>

                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                <select name="subcategory_id" id="subcategory" class="form-control">
                                   <option value="">---Select Sub-Category---</option>
                                   {{-- @foreach ($subcategories as $subcategory)
                                   <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>

                                   @endforeach --}}


                                </select>

                                </div>

                            </div>
                            <div class="col-lg-6">
                              <div class="mb-3">
                                <label for="" class="form-label">Enter Product Name</label>
                                <input type="text" name="product_name" class="form-control">
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                  <label for="" class="form-label">Enter Product Price</label>
                                  <input type="number" name="product_price" class="form-control">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-3">
                                  <label for="" class="form-label">Enter Product Discount</label>
                                  <input type="number" name="discount" class="form-control" placeholder="discount%">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="mb-3">
                                  <label for="" class="form-label">Enter Brand Name</label>
                                  
                                  {{-- <input type="text" name="product_brand" class="form-control" placeholder="Enter Brand Name"> --}}
                                  <select name="product_brand" id="" class="form-control brand_id">
                                    <option value="">---Select Brands---</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">
                                            {{$brand->brand_name}}
                                           
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                              </div>
                              <label for="" class="form-label mb-3">Enter Short Description</label>
                              <div class="col-lg-12">

                                  <textarea name="short_description" id="" cols="100" rows="8"></textarea>
                              </div>
                              <label for="" class="form-label mt-4 mb-3">Enter Long Description</label>
                              <div class="col-lg-12">

                                  <textarea name="long_description" id="summernote" cols="80" rows="10"></textarea>
                              </div>
                              <div class="col-lg-6 mt-4">
                                <div class="mb-3">
                                  <label for="" class="form-label">Propduct Preview</label>
                                  <input type="file" name="product_preview" class="form-control">
                                </div>
                              </div>
                              <div class="col-lg-6  mt-4">
                                <div class="mb-3">
                                  <label for="" class="form-label">Propduct thumbnail</label>
                                  <input type="file" name="product_thumbnail" class="form-control">
                                </div>
                              </div>

                        </div>
                        <div class="col-lg-12 col-sm-4 mt-2 mx-auto text-center">
                            <div class="mb-3">
                              <button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 1153px;">Primary button</button>
                            </div>
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
@if(session('success'))
<script>
    $(document).ready(function () {

            Swal.fire(
         'Good job!',
         'Successfully Inserted Product',
         'success'
)

    });
</script>

@endif




@endsection

<style> #toast-container > .toast-error{ background-color: #BD362F; } </style>

