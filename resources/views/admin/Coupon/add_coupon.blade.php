@extends('admin.admin_asset')
@section('content')
<div id="layoutSidenav">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Coupon</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Coupon</li>
                </ol>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>List Of The Coupon</h3>
                            </div>
                            <div class="card-body">
                               <table class="table table-striped text-center">
                                <tr>
                                    <th>Serial</th>
                                    <th>Coupon Code</th>
                                    <th>type</th>
                                    <th>Discount Amount</th>
                                    <th>Validity</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($coupons as $key=>$coupon)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$coupon->coupon_code}}</td>
                                    <td>
                                        @if($coupon->type == 1)
                                        Percentage
                                        @else
                                        Flat
                                        @endif

                                    </td>
                                    <td>
                                        {{$coupon->discount_amount}}
                                    </td>
                                    <td>
                                        {{$coupon->validity}}
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <a href="" class="btn btn-success">Edit</a>
                                            <a href="" class="btn btn-primary">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                               </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="text-danger">{{$error}}</div>
                            @endforeach
                        @endif
                            <div class="card-header">
                                <h3>Add Coupon</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{route('coupon.store')}}" method="POST">
                                    @csrf

                              
                                <div class="mb-3">
                                    <label for="" class="form-label">Coupon Code</label>
                                    <input type="text" name="coupon_code" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Select Type</label>
                                    <select name="type" id="discount_type" onchange="showDiscountInput()" class="form-control">
                                        <option value="">---Select Type-----</option>
                                        <option value="1">Percentage</option>
                                        <option value="2">Flat</option>
                                    </select>
                                </div>
                                <div id="percentageDiv" class="mb-3" style="display: none;">
                                    <label for="" class="form-label">Discount Amount</label>
                                    % <input type="number" name="discount_amount_per" class="form-control" placeholder="discount%">
                                </div>
                                <div id="flatDiv" class="mb-3" style="display: none;">
                                    <label for="" class="form-label">Discount Amount</label>
                                     <input type="number" name="discount_amount" class="form-control" placeholder="Flat">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-lable">Validity</label>
                                    <input type="date" name="validity" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                                
                            </div>
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
    // function showDiscountInput() {
    //     var discountType = document.getElementById("discount_type").value;
        
    //     if (discountType === "1") {
    //         document.getElementById("percentageDiv").style.display = "block";
    //         document.getElementById("flatDiv").style.display = "none";
    //     } else if (discountType === "2") {
    //         document.getElementById("percentageDiv").style.display = "none";
    //         document.getElementById("flatDiv").style.display = "block";
    //     } else {
    //         document.getElementById("percentageDiv").style.display = "none";
    //         document.getElementById("flatDiv").style.display = "none";
    //     }
    // }


    function showDiscountInput(){
        var discount_type = document.getElementById('discount_type').value;
        if(discount_type === "1"){
            document.getElementById('percentageDiv').style.display = "block";
            document.getElementById('flatDiv').style.display = "none";
        }else if(discount_type === "2"){
            document.getElementById('flatDiv').style.display = "block";
            document.getElementById('percentageDiv').style.display = "none";
        }else{
            document.getElementById('percentageDiv').style.display = "none";
            document.getElementById('flatDiv').style.display = "none";

        }
    }
</script>
@if(session('success'))
    
    <script>
        $(document).ready(function () {
            Swal.fire({
                title: 'Good job!',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        });
    </script>
@endif
@endsection