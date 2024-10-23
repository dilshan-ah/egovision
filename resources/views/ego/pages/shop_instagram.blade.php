@extends('layouts.ego-app')
@section('content')
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$title = TranslationHelper::translateText('Shop Instagram', $preferredLanguage);
$welcomeText = TranslationHelper::translateText('Welcome to Ego Vision world! <br>
Discover the eyes looks with our vibrant shades and see how the lenses could appear on you! Tag @desioeyes for a chance to be featured', $preferredLanguage);
@endphp
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- CSS links-->
<!-- fancybox -->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.css'>
<!-- magnific-popup -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
<link rel="stylesheet" href="{{asset('ego/shop_instagram.css')}}">
<section class="portfolio-section" id="portfolio">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>{{$title}}</h2>
                <p class="text-light">{{$welcomeText}}</p>
            </div>
        </div>
        <div class="portfolio-menu mt-2 mb-4">
            <nav class="controls">
                <button type="button" class="control outline  p-4" data-filter="all">All Shades</button>
                @foreach($colors as $color)
                <button type="button" class="control outline  p-4" data-filter=".{{ str_replace([' ', '&'], ['-', 'and'], strtolower($color->name)) }}
">{{$color->name}}</button>
                @endforeach
            </nav>
        </div>
        <ul class="row portfolio-item">
            @foreach($instaDatas as $data)
            <li class="mix {{ str_replace([' ', '&'], ['-', 'and'], strtolower($data->product->color->name)) }} col-md-3" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                <div class="wrapper" style="height: 350px;">
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
            </li>

            <div class="modal fade mt-0" id="exampleModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body bg-light" style="width: 100%; padding: 0; overflow: hidden">
                            <button type="button" class="btn-close position-absolute end-0 top-0" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="d-flex w-100">
                                <div style="width: 50%; border-radius: 7px">
                                    <img src="{{$data->post()['media_url']}}" style="width: 100%; height: 100%; object-fit: cover" alt="">
                                </div>

                                <div style="width: 50%;" class="py-5 px-3">
                                    @if($data->product)
                                    <div class="border bg-white p-2 d-flex flex-column align-items-center mb-3">
                                        <img src="{{asset(@$data->product->image_path)}}" style="width: 65%;" alt="">
                                        <h5>{{@$data->product->name}}</h5>
                                        <a href="{{route('addToCart.index',@$data->product->id)}}" class="btn btn-dark">Shop Now</a>
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
                                        <p>{{$data->post()['caption']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </ul>
    </div>
</section>
<!-- JS Links -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!-- Mixitup -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.2.2/mixitup.min.js'></script>
<!-- fancybox -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.js'></script>
<!-- Fancybox js -->
<script>
    /*Downloaded from https://www.codeseek.co/ezra_siton/mixitup-fancybox3-JydYqm */
    // 1. querySelector
    var containerEl = document.querySelector(".portfolio-item");
    // 2. Passing the configuration object inline
    //https://www.kunkalabs.com/mixitup/docs/configuration-object/
    var mixer = mixitup(containerEl, {
        animation: {
            effects: "fade translateZ(-100px)",
            effectsIn: "fade translateY(-100%)",
            easing: "cubic-bezier(0.645, 0.045, 0.355, 1)"
        }
    });
    // fancybox insilaze & options //
    $("[data-fancybox]").fancybox({
        loop: true,
        hash: true,
        transitionEffect: "slide",
        /* zoom VS next////////////////////
        clickContent - i modify the deafult - now when you click on the image you go to the next image - i more like this approach than zoom on desktop (This idea was in the classic/first lightbox) */
        clickContent: function(current, event) {
            return current.type === "image" ? "next" : false;
        }
    });
</script>
@endsection