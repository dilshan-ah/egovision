@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Order Id</th>
                            <th>Order Items</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Order Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <a href="{{route('addToCart.admin.view.order',$order->id)}}">{{$order->transaction_id}}</a>
                            </td>
                            <td>
                                <ol>
                                    @foreach($order->orderItems as $item)
                                    @if($item->product)
                                    <li>{{$item->product->name}} x {{$item->pair}}</li>
                                    @else
                                    <li><em>Product not available</em></li>
                                    @endif
                                    @endforeach
                                </ol>
                            </td>
                            <td>{{$order->amount}} BDT</td>
                            <td>
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
                            </td>
                            <td>{{ $order->created_at->timezone('Asia/Dhaka')->format('d, M Y / h:i A') }}<br>
                                <small>{{ $order->created_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($orders->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($orders) }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('breadcrumb-plugins')
<div class="mb-2"><x-search-form placeholder="Order Order Id/Price" /></div>
@endpush