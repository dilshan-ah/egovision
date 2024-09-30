@extends('layouts.app')

@section('content')
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title" style="font-size: 30px; color: black">{{ __($pageTitle) }}</h5>
                </div>

                <div class="row my-5">
                    @foreach ($wishlists as $wishlist)
                    <div class="col-6 mb-2">
                        <div class="card-product-slider mx-2">
                            <div class="card-product-slider-img-wrapper position-relative">
                                <img src="{{ asset($wishlist->product->image_path) }}" class="card-product-slider-img-top w-100">
                                <a href="{{ route('addToCart.index', $wishlist->product->id) }}" class="stretched-link"></a>

                                <form action="{{route('wishlist.delete',$wishlist->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="badge bg-danger text-white position-absolute" style="border-radius: 0; font-size: 10px; padding: 10px; right: 20px; top: 20px; border: 0; z-index: 99999 !important">
                                        <i class="fi fi-br-cross"></i>
                                    </button>
                                </form>

                            </div>
                            <div class="card-product-slider-body">
                                <h5 class="card-product-slider-title">{{ $wishlist->product->name }}</h5>
                                <small class="price">STARTING AT : {{ $wishlist->product->price }} {{ 'BDT' }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection