@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-12 mb-5">
            <h1>{{$pageTitle}}</h1>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table bg-light">
                    <thead>
                        <tr>
                            <th>@lang('Id')</th>
                            <th>@lang('Product')</th>
                            <th>@lang('Price')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Issued At')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returnProducts as $returnProduct)
                        <tr>
                            <td>{{$returnProduct->return_id}}</td>
                            <td>{{$returnProduct->item->product->name}} x {{$returnProduct->quantity}}</td>
                            <td>{{$returnProduct->item->product->price * $returnProduct->quantity}}৳</td>
                            <td>{{$returnProduct->status}}</td>
                            <td>{{ $returnProduct->created_at ? $returnProduct->created_at->format('d, M y') : 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection