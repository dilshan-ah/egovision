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
                            <th>@lang('Id')</th>
                            <th>@lang('Product')</th>
                            <th>@lang('Price')</th>
                            <th>@lang('Reason')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Issued At')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returns as $return)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                {{$return->return_id}}
                            </td>
                            <td>
                                {{$return->item->product->name}} x {{$return->quantity}}
                            </td>
                            <td>{{$return->item->product->price * $return->quantity}} ৳</td>
                            <td>{{$return->reason}}</td>
                            <td>
                                <form id="orderStatusForm" action="{{ route('return.admin.status.change', $return->id) }}" method="post">
                                    @csrf
                                    <select name="status" id="orderStatus" class="form-control">
                                        <option value="requested" @if($return->status == 'requested') selected @endif>Requested</option>
                                        <option value="success" @if($return->status == 'success') selected @endif>Success</option>
                                        <option value="failed" @if($return->status == 'failed') selected @endif>Failed</option>
                                    </select>
                                </form>

                            </td>
                            <td>{{ $return->created_at->timezone('Asia/Dhaka')->format('d, M Y / h:i A') }}<br>
                                <small>{{ $return->created_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                error: function(xhr) {
                    // Handle validation or other errors
                    if (xhr.status == 400 || xhr.status == 422) {
                        iziToast.warning({
                            message: xhr.responseJSON.errors.join(', '), // Assuming errors is an array
                            position: 'topRight'
                        });
                    } else if (xhr.status == 404) {
                        iziToast.error({
                            message: 'Return product not found.',
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