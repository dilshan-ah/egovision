@extends('layouts.app')

@section('content')
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$itemText = TranslationHelper::translateText('items', $preferredLanguage);

$id = TranslationHelper::translateText('Id', $preferredLanguage);
$product = TranslationHelper::translateText('Products', $preferredLanguage);
$price = TranslationHelper::translateText('Price', $preferredLanguage);
$status = TranslationHelper::translateText('Status', $preferredLanguage);
$orderedat = TranslationHelper::translateText('Ordered At', $preferredLanguage);
@endphp
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
                            <th>{{$id}}</th>
                            <th>{{$product}}</th>
                            <th>{{$price}}</th>
                            <th>{{$status}}</th>
                            <th>{{$orderedat}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <a style="color: blue; text-decoration: underline" href="{{route('ego.single.orders',$order->id)}}">{{$order->transaction_id}}</a>
                            </td>
                            <td>
                                @if($order->orderItems)
                                @foreach($order->orderItems as $item)
                                <a href="{{route('addToCart.index', $item->product_id)}}">{{$loop->iteration}}/ {{$item->product->name ?? ''}} {{$item->power}}</a> ({{$item->pair}}{{$itemText}})<br>
                                @endforeach
                                @endif
                            </td>
                            <td>{{$order->amount}}BDT</td>
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