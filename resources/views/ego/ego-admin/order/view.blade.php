@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{route('addToCart.invoice',$order->id)}}" class="btn btn-outline-primary">Invoice</a>
        </div>
        <div class="col-8 mb-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Ordered Items</h6>
                    @if($order->status == 'Pending')
                    <span class="badge bg-info text-white">Pending</span>
                    @elseif($order->status == 'Processing')
                    <span class="badge bg-primary text-white">Processing</span>
                    @elseif($order->status == 'Shipped')
                    <span class="badge bg-warning text-black">Shipped</span>
                    @elseif($order->status == 'Completed')
                    <span class="badge bg-success text-white">Completed</span>
                    @elseif($order->status == 'Failed')
                    <span class="badge bg-danger text-white">Failed</span>
                    @elseif($order->status == 'Cancelled')
                    <span class="badge bg-danger text-white">Cancelled</span>
                    @elseif($order->status == 'Returned')
                    <span class="badge bg-secondary text-white">Returned</span>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{@$item->product->name ?? ''}}</td>
                                <td>{{@$item->price/@$item->pair ?? ''}}৳</td>
                                <td>{{@$item->pair}}</td>
                                <td>{{@$item->price}}৳</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Subtotal</th>
                                <th>{{@$order->subtotal}}৳</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Discount</th>
                                <th>-{{@$order->discount}}৳</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Delivery Charge</th>
                                <th>{{@$order->delivery_charge}}৳</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>{{@$order->amount}}৳</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Order Status History</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @if(@$order->created_at)
                            <tr>
                                <td class="text-info">Order has been placed and pending</td>
                                <td>{{ diffForHumans(@$order->created_at) }}</td>
                            </tr>
                            @endif
                            @if(@$order->processing_time)
                            <tr>
                                <td class="text-primary">
                                    Order is being processed <br>
                                    <i class="text-secondary">Note: {{$processingNote->note ?? ''}}</i>
                                </td>
                                <td>{{ diffForHumans(@$order->processing_time) }}</td>
                            </tr>
                            @endif

                            @if($order->shipping_time)
                            <tr>
                                <td class="text-warning">Order has been shipped <br>
                                    <i class="text-secondary">Note: {{$shippingNote->note ?? ''}}</i>
                                </td>
                                <td>{{ diffForHumans(@$order->shipping_time) }}</td>
                            </tr>
                            @endif

                            @if($order->completing_time)
                            <tr>
                                <td class="text-success">Order is completed <br>
                                    <i class="text-secondary">Note: {{$completingNote->note ?? ''}}</i>
                                </td>
                                <td>{{ diffForHumans(@$order->completing_time) }}</td>
                            </tr>
                            @endif

                            @if($order->failing_time)
                            <tr>
                                <td class="text-danger">Order has failed <br>
                                    <i class="text-secondary">Note: {{$failingNote->note ?? ''}}</i>
                                </td>
                                <td>{{ diffForHumans(@$order->failing_time) }}</td>
                            </tr>
                            @endif

                            @if($order->cancelling_time)
                            <tr>
                                <td class="text-danger">Order has been canceled <br>
                                    <i class="text-secondary">Note: {{$cancellingNote->note ?? ''}}</i>
                                </td>
                                <td>{{ diffForHumans(@$order->cancelling_time) }}</td>
                            </tr>
                            @endif

                            @if($order->returning_time)
                            <tr>
                                <td class="text-secondary">Order has been returned <br>
                                    <i class="text-secondary">Note: {{$returningNote->note ?? ''}}</i>
                                </td>
                                <td>{{ diffForHumans(@$order->returning_time) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card">
                <form id="orderStatusForm" action="{{route('addToCart.admin.change.status',$order->id)}}" method="post" class="p-3">
                    @csrf
                    <label for="orderStatus">Change Status</label>
                    <select name="status" id="orderStatus" class="form-control">
                        <option value="Pending" @if($order->status == 'Pending') selected @endif>Pending</option>
                        <option value="Processing" @if($order->status == 'Processing') selected @endif>Processing</option>
                        <option value="Shipped" @if($order->status == 'Shipped') selected @endif>Shipped</option>
                        <option value="Complete" @if($order->status == 'Complete') selected @endif>Complete</option>
                        <option value="Failed" @if($order->status == 'Failed') selected @endif>Failed</option>
                        <option value="Canceled" @if($order->status == 'Canceled') selected @endif>Canceled</option>
                        <option value="Returned" @if($order->status == 'Returned') selected @endif>Returned</option>
                    </select>

                    <label for="note" class="mt-3">Note</label>
                    <textarea name="note" id="note" class="form-control" placeholder="Add a note here"></textarea>

                    <button class="btn btn-primary mt-3" type="submit">Update</button>
                </form>
            </div>
        </div>
        <div class="col-4 mb-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Payment status</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('addToCart.admin.change.payment',$order->id)}}" method="post">
                        @csrf
                        <select name="payment_status" id="" class="form-control mb-3">
                            <option value="paid" @if($order->payment_status == 'paid') selected @endif>Paid</option>
                            <option value="unpaid" @if($order->payment_status == 'unpaid') selected @endif>Unpaid</option>
                        </select>


                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                </div>
                <div class="card-body">
                    <h4>{{@$order->user->firstname}} {{@$order->user->lastname}}</h4>
                    <h4>{{@$order->user->email}}</h4>
                    <h4>{{@$order->user->mobile}}</h4>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Billing Address</h6>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#addressModal" class="btn"><i class="fas fa-pen text-primary"></i></button>
                </div>
                <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Billing Address</h1>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('addToCart.admin.change.address',$order->id)}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            Name
                                        </label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$order->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            Email
                                        </label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{$order->email}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            Phone
                                        </label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{$order->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company" class="form-label">
                                            Company
                                        </label>
                                        <input type="text" name="company" id="company" class="form-control" placeholder="Company" value="{{$order->company}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address_one" class="form-label">
                                            Address one
                                        </label>
                                        <input type="text" name="address_one" id="address_one" class="form-control" placeholder="Address one" value="{{$order->address_one}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="form-label">
                                            City
                                        </label>
                                        <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{$order->city}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">
                                            State
                                        </label>
                                        <input type="text" name="state" id="state" class="form-control" placeholder="State" value="{{$order->state}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="form-label">
                                            Country
                                        </label>
                                        <input type="text" name="country" id="country" class="form-control" placeholder="Country" value="{{$order->country}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="zip_code" class="form-label">
                                            Zip code
                                        </label>
                                        <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="Zip code" value="{{$order->zip_code}}">
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4>{{@$order->name}}</h4>
                    <h4>{{@$order->email}}</h4>
                    <h4>{{@$order->phone}}</h4>
                    <h4>{{@$order->address_one}}</h4>
                    <h4>{{@$order->address_two}}</h4>
                    <h4>{{@$order->company}}</h4>
                    <h4>{{@$order->city}},{{$order->zip_code}}</h4>
                    <h4>{{@$order->state}}</h4>
                    <h4>{{@$order->country}}</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Payment Method</h4>
                </div>
                <div class="card-body">
                    @if($order->payment_method == 'cod')
                    <h4>Cash on delivery</h4>
                    @else
                    <h4>SSL Commerze</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@endsection

@push('custom-icon')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/v4-shims.min.css" integrity="sha512-p++g4gkFY8DBqLItjIfuKJPFvTPqcg2FzOns2BNaltwoCOrXMqRIOqgWqWEvuqsj/3aVdgoEo2Y7X6SomTfUPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush