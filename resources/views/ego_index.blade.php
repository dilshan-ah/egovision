@extends('layouts.ego-app')
@section('content')
@include('ego.include.banner', ['banners' => $banners])

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
</style>


<div class="container my-5">
    <div class="row">
        <div class="col">
            <h3 class="text-center">Welcome to Ego Vision Color Contact Lenses Official Store!</h3>
            <p>
            Ego Vision, a sister company of Fashion Group, is a leading distributor of colored and powered contact lenses in Bangladesh. Since our establishment, we have prioritized offering top-quality products and services sourced globally. Our brand, “Ego Vision,” provides a wide selection of certified color contact lenses. These lenses are crafted to seamlessly complement your natural eye color, resulting in a subtle and realistic appearance. The effect of the colored lenses may differ depending on the natural hue of your iris. Additionally, our lenses can lighten darker eyes and enhance brighter ones for a striking visual transformation. We provide Premium shipping with an average delivery time of 24 to 48 hours, depending on the location within the country. Our lenses are available in our 18 exclusive optical stores and are also distributed through over 1,500 small and medium retail outlets nationwide.
            </p>

        </div>
    </div>
    <div class="mt-5 container">
        <div class="m-1">
            <div class="row">
                @foreach($colors as $color)
                <div class="col-12 col-md-6 col-lg-4 mb-4"> <!-- Adjusted classes -->
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
                <h3> {{$collectionSet->category->name}}</h3>
                <h3> {{$collectionSet->tone->name ?? ''}}</h3>
                <h5 class="mt-2"> @lang('messages.discover')</h5>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach($collectionSet->products as $product )
            @if($product)
            <div class="col-md-6 mb-4">
                <a href="{{ route('addToCart.index', $product->id) }}" class="card-link d-block ">
                    <div class="card border-0 text-center ">
                        <div class="card-video-top overflow-hidden position-relative">
                            <!-- <video src="{{ asset('ego/video/motion.mp4') }}" class="card-video img-fluid" alt="Video 1"
                                autoplay loop muted playsinline>
                                Your browser does not support the video tag.
                            </video> -->
                            <img src="{{asset($product->image_path)}}" style="width: 100%; height: 100%; object-fit: cover" alt="">
                        </div>
                        <div class="card-body">
                            <h5>{{$product->name}}</h5>
                            <h6>@lang('messages.shop_color')</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            @endforeach

        </div>
    </div>
     @endforeach
    
    <!-- ------------------------------------------------------------------- -->



    <div class="container">
        <h3>@lang('messages.More_Ego_Vision_Lenses')</h3>
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
                            <h5 class="card-product-slider-title">{{$moreProduct->name}}</h5>
                            <small class="price">{{$moreProduct->price}}৳</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <p>@lang('messages.FOLLOW_US_ON')</p>
        <h3>@lang('messages.instagram')</h3>
        <p>@lang('messages.GO_FOLLOW_Ego_Vision')</p>
        <div>
            <div class="row row-cols-1 row-cols-md-5 g-4">
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <video style="width: 100%" autoplay loop muted playsinline>
                                <source src="{{ asset('ego/video/demovideo.mp4') }}" type="video/mp4" />
                            </video>
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <img src="{{ asset('ego/img3.jpeg') }}" />
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <img src="{{ asset('ego/img1.jpeg') }}" />
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <video style="width: 100%" autoplay loop muted playsinline>
                                <source src="{{ asset('ego/video/motion.mp4') }}" type="video/mp4" />
                            </video>
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                                <!-- <a class="link-a" href="#">View And Shop</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <video style="width: 100%" autoplay loop muted playsinline>
                                <source src="{{ asset('ego/video/demovideo.mp4') }}" type="video/mp4" />
                            </video>
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                                <!-- <a class="link-a" href="#">View And Shop</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <img src="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17929953719331586_0.jpg" alt="" />
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                                <!-- <a class="link-a" href="#">View And Shop</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <img src="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17929953719331586_0.jpg" alt="" />
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                                <!-- <a class="link-a" href="#">View And Shop</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <img src="https://m.photoslurp.com/i/fit?width=720&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17977397470323891_0.jpg" />
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
                                    <p class="text-p">
                                        <span class="icon-wrapper">
                                            <i class="fab fa-instagram "></i>
                                        </span>
                                        <span class="details">
                                            <i class="fa-regular fa-heart"></i><span class="text-white">@lang('messages.120')</span>
                                            <i class="fa-solid fa-comments"></i><span class="text-white">@lang('messages.30')</span>
                                        </span>
                                    </p>
                                </div>
                                <!-- <a class="link-a" href="#">View And Shop</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <img src="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17901155806886312_0.jpg" />
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                                <!-- <a class="link-a" href="#">View And Shop</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-mb-2 col-12" style="cursor: pointer">
                    <div class="wrapper">
                        <div class="cardd">
                            <img src="https://m.photoslurp.com/i/fit?width=360&height=359&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18003480121418500_1.jpg" />
                            <div class="overlay">
                                <div class="text-center">
                                    <h5 class="title">@lang('messages.Salon_31')</h5>
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
                                <!-- <a class="link-a" href="#">View And Shop</a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <button href="#" class="add-to-cart-button w-25 mt-4 text-nowrap">@lang('messages.LoadMore')</button>
            </div>
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
                                <i class="fas fa-check-circle mx-2" style="color:#6c6c85;"></i>@lang('messages.Verified')
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">@lang('messages.Great_quality')</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">@lang('messages.quality')</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">@lang('messages.Angela')</small>
                    </div>
                </div>
            </div>
            <div class="row slider" style="cursor: pointer;">
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
                                <i class="fas fa-check-circle mx-2" style="color: #6c6c85;;"></i>@lang('messages.Verified')
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">@lang('messages.Great_quality')</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">@lang('messages.quality')</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">@lang('messages.Angela')</small>
                    </div>
                </div>
            </div>
            <div class="row slider" style="cursor: pointer;">
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
                                <i class="fas fa-check-circle mx-2" style="color: #6c6c85;;"></i>@lang('messages.Verified')
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">@lang('messages.Great_quality')</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">@lang('messages.quality')</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">@lang('messages.Angela')</small>
                    </div>
                </div>
            </div>
            <div class="row slider" style="cursor: pointer;">
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
                                <i class="fas fa-check-circle mx-2" style="color: #6c6c85;;"></i>@lang('messages.Verified')
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">@lang('messages.Great_quality')</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">@lang('messages.quality')</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">@lang('messages.Angela')</small>
                    </div>
                </div>
            </div>
            <div class="row slider" style="cursor: pointer;">
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
                                <i class="fas fa-check-circle mx-2" style="color: #6c6c85;;"></i>@lang('messages.Verified')
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">@lang('messages.Great_quality')</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">@lang('messages.quality')</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">@lang('messages.Angela')</small>
                    </div>
                </div>
            </div>
            <div class="row slider" style="cursor: pointer;">
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
                                <i class="fas fa-check-circle mx-2" style="color: #6c6c85;"></i>@lang('messages.Verified')
                            </span>
                        </div>
                        <p class="mb-1 text-lg font-bold" style="line-height: 1.2; "><b style="font-size:14px">@lang('messages.Great_quality')</b></p>
                        <p class="mb-4 text-gray-700" style="line-height: 1.2; font-size:14px">@lang('messages.quality')</p>
                        <small style="margin-top:-30px;position: absolute;font-size:12px">@lang('messages.Angela')</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <small>@lang('messages.rate') <b>4.3</b>@lang('messages.reviews')</small> <br>
        <small> <i class="fas fa-star " style="color: #00b67a;font-size: 16px;"></i><strong>@lang('messages.Trustpilot') </strong></small>
    </div>
    @endsection