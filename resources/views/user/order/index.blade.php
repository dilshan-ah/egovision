@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table bg-light">
                    <thead>
                        <tr>
                            <th>@lang('Id')</th>
                            <th>@lang('Products')</th>
                            <th>@lang('Price')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Ordered At')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->transaction_id}}</td>
                            <td>
                                @foreach($order->orderItems as $item)
                                <a href="{{route('addToCart.index', $item->product_id)}}">{{$loop->iteration}}/ {{$item->product->name}}</a><br>
                                @endforeach
                            </td>
                            <td>{{$order->amount}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{ $order->created_at ? $order->created_at->format('d, M y') : 'N/A' }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection