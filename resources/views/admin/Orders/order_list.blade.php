@extends('admin.admin_asset')
@section('content')
<div id="layoutSidenav" class="mb-3">

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active">Order Lists
                
                    </ol>
           
             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Order List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="datatablesSimple">
                                <tr>
                                    <th>Serial</th>
                                    <th>Order Id</th>
                                    <th>Sub Total</th>
                                    <th>Discount</th>
                                    <th>Charge</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                  @forelse($orders as $key=>$order)
                                <tr>
                                    <td>{{$key+1}} </td>
                                    <td>
                                        <span class="badge bg-primary">{{$order->order_id}}</span> </td>
                                    <td>{{$order->subtotal}} </td>
                                    <td>{{$order->discount}} </td>
                                    <td>{{$order->charge}} </td>
                                    <td>{{$order->Total}} </td>
                                    <td>
                                        @if($order->payment_method == 1)
                                        Cash On Delivary
                                        @elseif($order->payment_method == 2)
                                        Ssl Commerze
                                        @else
                                        Strie
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status == null)
                                        <span class="badge bg-dark"> Placed</span>
                                        @elseif($order->status == 1)
                                        <span class="badge bg-success"> Packaging</span>
                                        
                                        @elseif($order->status == 2)
                                        <span class="badge bg-warning"> Shipped</span>
                                       
                                        @elseif($order->status == 3)
                                        <span class="badge bg-primary">Ready To Delivar</span>
                                      
                                        @elseif($order->status == 4)
                                        <span class="badge bg-danger"> Delivered</span>
                                        @endif
                                    </td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                              Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="">Details</a></li>

                                              <li><a class="dropdown-item" href="{{ route('order.status', ['order_id' => $order->order_id,'value'=>0]) }}">Placed</a></li>
                                              <li><a class="dropdown-item" href="{{route('order.status', ['order_id' => $order->order_id,'value'=>1])}}">Packaging</a></li>
                                              <li><a class="dropdown-item" href="{{route('order.status', ['order_id' => $order->order_id,'value'=>2])}}">Shipped</a></li>
                                              <li><a class="dropdown-item" href="{{route('order.status', ['order_id' => $order->order_id,'value'=>3])}}">Ready To Delivar</a></li>
                                              <li><a class="dropdown-item" href="{{route('order.status', ['order_id' => $order->order_id,'value'=>4])}}">Delivered</a></li>
                                            </ul>
                                          </div>
                                    </td>
                                </tr>
                                @empty
                                No order
                                @endforelse
                                
                            </table>
                        </div>
                    </div>
                </div>
             </div>
            </div>
             
            </div>
            

            </div>
           

        </main>
       
    </div>
    
</div>

@endsection
