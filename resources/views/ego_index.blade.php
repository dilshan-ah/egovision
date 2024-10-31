@extends('layouts.ego-app')
@section('content')
@include('ego.include.banner', ['banners' => $banners])
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
<style>
    /* Background overlay */
    .search-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    /* Popup content */
    .search-popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 500px;
        position: relative;
    }

    /* Close button */
    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
    }

    /* Input container */
    /* Search input field */
    #search-input {
        flex: 1;
        border: none;
        padding: 10px;
        font-size: 16px;
        outline: none;
        border-radius: 4px 0 0 4px;
        background: #f9f9f9;
    }

    /* Search icon */
    .search-icon {
        width: 20px;
        height: 20px;
        margin-left: 10px;
        cursor: pointer;
    }

    /* Hover and focus effects */
    #search-input:focus {
        border-bottom: 2px solid black;
    }

    .search-icon:hover {
        opacity: 0.7;
    }

    /* Hide the popup by default */
    .search-popup {
        display: none;
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Black background with opacity */
        justify-content: flex-end;
        align-items: flex-start;
        z-index: 1000;
        padding: 20px;
    }

    /* Style the popup content */
    .search-popup-content {
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        width: 300px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Style the input field */
    #search-input {
        width: 80%;
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Style the close button */
    #close-popup {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .card-anime img{
        transition: transform 1s ease;
    }

    .card-anime:hover img{
        transform: scale(1.1);
    }
</style>

@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$welcomeText = TranslationHelper::translateText('Welcome to Ego Vision Color Contact Lenses Official Store!', $preferredLanguage);

$aboutText = TranslationHelper::translateText('Ego Vision, a sister company of Fashion Group, is a leading distributor of colored and powered contact lenses in Bangladesh. Since our establishment, we have prioritized offering top-quality products and services sourced globally. Our brand, “Ego Vision,” provides a wide selection of certified color contact lenses. These lenses are crafted to seamlessly complement your natural eye color, resulting in a subtle and realistic appearance. The effect of the colored lenses may differ depending on the natural hue of your iris. Additionally, our lenses can lighten darker eyes and enhance brighter ones for a striking visual transformation. We provide Premium shipping with an average delivery time of 24 to 48 hours, depending on the location within the country. Our lenses are available in our 18 exclusive optical stores and are also distributed through over 1,500 small and medium retail outlets nationwide.', $preferredLanguage);

$discobtn = TranslationHelper::translateText('Discover', $preferredLanguage);
$shopbtn = TranslationHelper::translateText('Shop The Color', $preferredLanguage);

$moreText = TranslationHelper::translateText('More Ego Vision Lenses', $preferredLanguage);

$followText = TranslationHelper::translateText('FOLLOW US ON', $preferredLanguage);
$instaText = TranslationHelper::translateText('Instagram', $preferredLanguage);
$followEgo = TranslationHelper::translateText('GO FOLLOW @Ego Vision', $preferredLanguage);

$loadbtn = TranslationHelper::translateText('See More', $preferredLanguage);

$reviewVerified = TranslationHelper::translateText('Verified', $preferredLanguage);
$reviewQuality = TranslationHelper::translateText('Great Quality', $preferredLanguage);
$quality = TranslationHelper::translateText('Quality', $preferredLanguage);
$nameTime = TranslationHelper::translateText('Angela 5 hour ago', $preferredLanguage);

$ratedText = TranslationHelper::translateText('Rated', $preferredLanguage);
$rateDetText = TranslationHelper::translateText('5 based on 908 reviews.Showing our 5 star reviews', $preferredLanguage);
$trustpilotText = TranslationHelper::translateText('Trustpilot', $preferredLanguage);

@endphp

@if(session('orderSuccess'))
<!-- Custom Backdrop -->
<!-- <div id="custom-backdrop" class="custom-backdrop"></div> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="shadow-none d-flex flex-column align-items-center">
                    <i class="fi fi-ss-check-circle" style="font-size: 70px;"></i>
                    <h2 class="modal-title text-center mb-4" id="exampleModalLabel">{{ session('orderSuccess') }}</h2>
                    <div class="d-flex w-100 justify-content-center">
                        <a href="{{route('ego.orders')}}" class="btn btn-dark">Order History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles for Backdrop -->
<style>
    .custom-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        /* Semi-transparent background */
        z-index: 1040;
        /* Ensure it appears below the modal but above other content */
        display: none;
        /* Hidden by default */
    }
</style>

<!-- jQuery to trigger the modal and backdrop on page load -->
<script>
    $(document).ready(function() {
        // Show modal
        $('#exampleModal').modal('show');

        // Show custom backdrop when modal opens
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#custom-backdrop').fadeIn(); // Fade in the custom backdrop
        });

        // Hide custom backdrop when modal closes
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#custom-backdrop').fadeOut(); // Fade out the custom backdrop
        });
    });
</script>
@endif


<div class="container my-5">
    <div class="row">
        <div class="col">

            <h3 class="text-center">
                {{$welcomeText}}
            </h3>
            <p class="text-justify">
                {{$aboutText}}
            </p>

        </div>
    </div>
    <div class="mt-5 container">
        <div class="m-1">
            <div class="row">
                @foreach($colors as $color)
                <div class="col-12 col-md-6 col-lg-4 mb-4 card-anime"> <!-- Adjusted classes -->
                    <a href="{{route('color.single.color',$color->id)}}" class="card-link">
                        <div class="card border-0 text-center">
                            <div class="overflow-hidden">
                                <a href="{{route('color.single.color',$color->id)}}">
                                    <img src="{{asset($color->image_path)}}" class="img-fluid" alt="Image 1" />
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="text-capitalize"> {{$color->name}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Welcome section END-->
    <!-- Attitude collection  -->
    @foreach($collectionSets as $collectionSet)
    <div class="container text-center my-5">

        <div class="row">
            <div class="col">
                <h3> {{@$collectionSet->category->name}}</h3>
                <h3> {{@$collectionSet->tone->name ?? ''}}</h3>
                <a href="{{route('collectionSet.single.collection',$collectionSet->id)}}" class="mt-2">
                    {{$discobtn}}</a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach($collectionSet->products as $product )
            @if($product)
            <div class="col-md-6 mb-4 card-anime">
                <a href="{{ route('addToCart.index', $product->id) }}" class="card-link d-block ">
                    <div class="card border-0 text-center ">
                        <div class="card-video-top overflow-hidden position-relative">
                            <img src="{{asset($product->image_path)}}" style="width: 100%; height: 100%; object-fit: cover" alt="">
                        </div>
                        <div class="card-body">
                            <h5>{{$product->name}}</h5>
                            <h6>{{$shopbtn}}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            @endforeach

        </div>
    </div>
    @endforeach

    <!--------------------------------------------------------------------- -->



    <div class="container">
        <h3>{{ $moreText }}</h3>
    </div>

    <div class="mt-5 container">
        <div class="row">
            <div class="col-12">
                <div class="product-slider d-flex flex-nowrap overflow-hidden ">
                    @foreach($moreProducts as $moreProduct)
                    <div class="card-product-slider mx-2 mb-5">

                        <div class="card-product-slider-img-wrapper ">
                            <img src="{{asset($moreProduct->image_path)}}" class="card-product-slider-img-top" alt="...">
                            <a href="{{ route('addToCart.index', $moreProduct->id) }}" class="stretched-link"></a>
                            <div class="card-product-slider-icons">
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-share"></i>
                            </div>
                        </div>
                        <div class="card-product-slider-body">
                            <h5 class="card-product-slider-title">{{ $moreProduct->name }}</h5>
                            <small class="price">{{ $moreProduct->price }} BDT</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <p>{{ $followText }}</p>
        <h3>{{ $instaText }}</h3>
        <p>{{ $followEgo }}</p>
        <div class="d-flex flex-column align-items-center">
            <div class="row w-100 g-4">

                @foreach($instaDatas as $data)
                <div class="col-md-2" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                    <div class="wrapper">
                        <div class="cardd">
                            <img src="{{ $data->post()['media_url'] }}" />
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">{{ $data->post()['username'] }}</h5>
                                    <p class="text-p">
                                        <span class="icon-wrapper">
                                            <i class="fab fa-instagram"></i>
                                        </span>
                                        <span class="details">
                                            <i class="fa-regular fa-heart"></i><span class="text-white">@lang('messages.120')</span>
                                            <i class="fa-solid fa-comments"></i><span class="text-white">@lang('messages.30')</span>
                                        </span>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade mt-0" id="exampleModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-body bg-light" style="width: 100%; padding: 0; overflow: hidden">
                                <button type="button" class="btn-close position-absolute end-0 top-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="d-flex w-100">
                                    <div style="width: 50%; border-radius: 7px">
                                        <img src="{{@$data->post()['media_url']}}" style="width: 100%; height: 100%; object-fit: cover" alt="">
                                    </div>

                                    <div style="width: 50%;" class="py-5 px-3">
                                        @if(@$data->product)
                                        <div class="border bg-white p-2 d-flex flex-column align-items-center mb-3">
                                            <img src="{{asset(@$data->product->image_path)}}" style="width: 65%;" alt="">
                                            <h5>{{@$data->product->name}}</h5>
                                            <a href="{{route('addToCart.index',$data->product->id)}}" class="btn btn-dark">Shop Now</a>
                                        </div>
                                        @endif
                                        <div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="fab fa-instagram"></i>
                                                    <a href="{{$data->post()['permalink']}}" target="_blank">{{$data->post()['username']}}</a>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="d-flex align-items-center gap-1">
                                                        <i class="far fa-heart"></i>
                                                        666
                                                    </div>

                                                    <div class="d-flex align-items-center gap-1">
                                                        <i class="far fa-comment"></i>
                                                        56
                                                    </div>
                                                </div>
                                            </div>
                                            <p>{{@$data->post()['caption']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <a href="{{route('ego.pages.shop.instagram')}}" class="add-to-cart-button w-25 mt-4 text-nowrap">{{ $loadbtn }}</a>
        </div>
    </div>
    <div class="mt-5">
        <div class="multiple-items container ">
            <!-- Navigation Buttons -->


            <!-- Slider Content -->
            <div class="row slider " style="cursor: pointer;">
                <div class="col-12">
                    <div class="card-body card-body-slider">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-500 ">
                                <i class="fas fa-check-circle mx-2" style="color:#6c6c85;"></i>{{ $reviewVerified }}
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">{{ $reviewQuality }}</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">{{ $quality }}</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">{{ $nameTime }}</small>
                    </div>
                </div>
            </div>
            <div class="row slider " style="cursor: pointer;">
                <div class="col-12">
                    <div class="card-body card-body-slider">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-500 ">
                                <i class="fas fa-check-circle mx-2" style="color:#6c6c85;"></i>{{ $reviewVerified }}
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">{{ $reviewQuality }}</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">{{ $quality }}</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">{{ $nameTime }}</small>
                    </div>
                </div>
            </div>
            <div class="row slider " style="cursor: pointer;">
                <div class="col-12">
                    <div class="card-body card-body-slider">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-500 ">
                                <i class="fas fa-check-circle mx-2" style="color:#6c6c85;"></i>{{ $reviewVerified }}
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">{{ $reviewQuality }}</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">{{ $quality }}</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">{{ $nameTime }}</small>
                    </div>
                </div>
            </div>
            <div class="row slider " style="cursor: pointer;">
                <div class="col-12">
                    <div class="card-body card-body-slider">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-500 ">
                                <i class="fas fa-check-circle mx-2" style="color:#6c6c85;"></i>{{ $reviewVerified }}
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">{{ $reviewQuality }}</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">{{ $quality }}</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">{{ $nameTime }}</small>
                    </div>
                </div>
            </div>
            <div class="row slider " style="cursor: pointer;">
                <div class="col-12">
                    <div class="card-body card-body-slider">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-500 ">
                                <i class="fas fa-check-circle mx-2" style="color:#6c6c85;"></i>{{ $reviewVerified }}
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">{{ $reviewQuality }}</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">{{ $quality }}</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">{{ $nameTime }}</small>
                    </div>
                </div>
            </div>
            <div class="row slider " style="cursor: pointer;">
                <div class="col-12">
                    <div class="card-body card-body-slider">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="icon-wrapper">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-500 ">
                                <i class="fas fa-check-circle mx-2" style="color:#6c6c85;"></i>{{ $reviewVerified }}
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">{{ $reviewQuality }}</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">{{ $quality }}</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">{{ $nameTime }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <small>{{ $ratedText }} <b>4.3</b>{{ $rateDetText }}</small> <br>
        <small> <i class="fas fa-star " style="color: #00b67a;font-size: 16px;"></i><strong>{{ $trustpilotText }}</strong></small>
    </div>
    @endsection