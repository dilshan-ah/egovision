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
                            <td>{{$order->amount}} ৳</td>
                            <td>
                                <form id="orderStatusForm-{{$order->id}}" action="{{route('addToCart.admin.change.status', $order->id)}}" method="post">
                                    @csrf
                                    <select name="status" id="orderStatus-{{$order->id}}" class="form-control order-status" data-order-id="{{$order->id}}">
                                        <option value="Pending" @if($order->status == 'Pending') selected @endif>Pending</option>
                                        <option value="Processing" @if($order->status == 'Processing') selected @endif>Processing</option>
                                        <option value="Shipped" @if($order->status == 'Shipped') selected @endif>Shipped</option>
                                        <option value="Complete" @if($order->status == 'Complete') selected @endif>Complete</option>
                                        <option value="Failed" @if($order->status == 'Failed') selected @endif>Failed</option>
                                        <option value="Canceled" @if($order->status == 'Canceled') selected @endif>Canceled</option>
                                        <option value="Returned" @if($order->status == 'Returned') selected @endif>Returned</option>
                                    </select>
                                </form>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Detect changes in any of the status dropdowns
        $('.order-status').change(function() {
            var orderID = $(this).data('order-id'); // Get the order ID from the data attribute
            var selectedStatus = $(this).val(); // Get the selected status
            var formAction = $('#orderStatusForm-' + orderID).attr('action'); // Get the form action specific to this order
            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token

            $.ajax({
                url: formAction, // The URL from the form action
                type: 'POST',
                data: {
                    _token: csrfToken, // Include CSRF token
                    status: selectedStatus // Send the selected status
                },
                success: function(response) {
                    // Show a success message with iziToast
                    iziToast.success({
                        message: response.message,
                        position: 'topRight'
                    });
                },
                error: function(xhr, status, error) {
                    // Handle validation or other errors
                    if (xhr.status == 400 || xhr.status == 422) {
                        iziToast.warning({
                            message: xhr.responseJSON.errors,
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            message: 'An error occurred while updating the order status.',
                            position: 'topRight'
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
@push('breadcrumb-plugins')
<div class="mb-2"><x-search-form placeholder="Order Order Id/Price" /></div>
@endpush