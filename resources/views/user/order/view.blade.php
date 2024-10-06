@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-8 col-12 mb-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Ordered Items</h6>
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
                                <td>{{$item->product->name ?? ''}}</td>
                                <td>{{$item->product->price ?? ''}}৳</td>
                                <td>{{$item->pair}}</td>
                                <td>{{$item->pair*($item->product->price ?? 0)}}৳</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Subtotal</th>
                                <th>{{$order->subtotal}}৳</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Discount</th>
                                <th>-{{$order->discount}}৳</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Delivery Charge</th>
                                <th>{{$order->delivery_charge}}৳</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>{{$order->amount}}৳</th>
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
                            @if($order->created_at)
                            <tr>
                                <td class="text-info">Order has been placed and pending</td>
                                <td>{{ diffForHumans($order->created_at) }}</td>
                            </tr>
                            @endif
                            @if($order->processing_time)
                            <tr>
                                <td class="text-primary">Order is being processed</td>
                                <td>{{ diffForHumans($order->processing_time) }}</td>
                            </tr>
                            @endif

                            @if($order->shipping_time)
                            <tr>
                                <td class="text-warning">Order has been shipped</td>
                                <td>{{ diffForHumans($order->shipping_time) }}</td>
                            </tr>
                            @endif

                            @if($order->completing_time)
                            <tr>
                                <td class="text-success">Order is completed</td>
                                <td>{{ diffForHumans($order->completing_time) }}</td>
                            </tr>
                            @endif

                            @if($order->failing_time)
                            <tr>
                                <td class="text-danger">Order has failed</td>
                                <td>{{ diffForHumans($order->failing_time) }}</td>
                            </tr>
                            @endif

                            @if($order->cancelling_time)
                            <tr>
                                <td class="text-danger">Order has been canceled</td>
                                <td>{{ diffForHumans($order->cancelling_time) }}</td>
                            </tr>
                            @endif

                            @if($order->returning_time)
                            <tr>
                                <td class="text-secondary">Order has been returned</td>
                                <td>{{ diffForHumans($order->returning_time) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12 mb-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                </div>
                <div class="card-body">
                    <h4>{{$order->user->firstname}} {{$order->user->lastname}}</h4>
                    <h4>{{$order->user->email}}</h4>
                    <h4>{{$order->user->mobile}}</h4>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Billing Address</h6>
                </div>
                <div class="card-body">
                    <h4>{{$order->name}}</h4>
                    <h4>{{$order->email}}</h4>
                    <h4>{{$order->phone}}</h4>
                    <h4>{{$order->address_one}}</h4>
                    <h4>{{$order->address_two}}</h4>
                    <h4>{{$order->company}}</h4>
                    <h4>{{$order->city}},{{$order->zip_code}}</h4>
                    <h4>{{$order->state}}</h4>
                    <h4>{{$order->country}}</h4>
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

@endsection