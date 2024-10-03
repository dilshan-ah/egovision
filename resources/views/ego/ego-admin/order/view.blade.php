@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card d-flex align-items-end">
                <form id="orderStatusForm" action="{{route('addToCart.admin.change.status',$order->id)}}" method="post" class="p-3" style="width: max-content;">
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
                </form>
            </div>
        </div>

        <div class="col-8 mb-4">
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
                                <th>0৳</th>
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
        <div class="col-4 mb-4">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Detect changes in the status dropdown
        $('#orderStatus').change(function() {
            var selectedStatus = $(this).val();
            var formAction = $('#orderStatusForm').attr('action');
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