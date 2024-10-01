@extends('layouts.ego-app')
@section('content')
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<br>
<br>
<br>
<br>
<br>
<div class="row mt-5">
    <div class="col-md-4 col-12" style="background: #F5F5F5;">
        <div class="p-4">
            <h1> Accessories</h1>
            <small>{{$products->count()}} PRODUCTS</small>
        </div>
    </div>

    <!-- ------------------------------------------------------------- -->
    <div class="col-md-8 col-12">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-6 col-12 mb-4">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="{{asset($product->image_path)}}" class="card-product-slider-img-top img-fluid" alt="...">
                        <a href="{{ route('addToCart.index', $product->id) }}" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <form id="add-to-wishlist-{{ $product->id }}" action="{{ route('wishlist.add', $product->id) }}" method="post">
                                @csrf
                            </form>

                            <a href="#" onclick="event.preventDefault(); document.getElementById('add-to-wishlist-{{ $product->id }}').submit();" class="add-to-wishlist" style="z-index: 9999;">
                                @if($product->wishlist)
                                <i class="fas fa-heart" style="background-color: white; color: black; display: flex;"></i>
                                @else
                                <i class="fi fi-rr-heart" style="background-color: white; color: black; display: flex;"></i>
                                @endif
                            </a>
                            <a href="https://www.instagram.com/?url={{route('addToCart.index', $product->id)}}" style="z-index: 9999;">
                                <i class="fas fa-share" style="background-color: white; color: black;"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">{{$product->name}}</h5>
                        <small class="price">STARTING AT: {{$product->price}} TK</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
