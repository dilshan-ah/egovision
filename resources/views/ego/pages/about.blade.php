@extends('layouts.ego-app')
@section('content')
<br>
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
$homeUrl =  TranslationHelper::translateText('Home', $preferredLanguage);
$aboutTitle = TranslationHelper::translateText('About', $preferredLanguage);
$aboutText = TranslationHelper::translateText("Explore Ego Vision's range of colored contact lens collections, known for being the best contacts for dark eyes, carefully designed to enhance your natural eye beauty. Dive into our collections to discover the uniqueness of each design. Whether you're seeking hazel, grey, blue, or green lenses, you'll find them here. Our offerings also include prescription colored contact lenses, with some collections catering to those with astigmatism.", $preferredLanguage);

$firstTitle = TranslationHelper::translateText("Timeless Collection", $preferredLanguage);
$firstSubTitle = TranslationHelper::translateText("3 Tones - Monthly", $preferredLanguage);
$firstDesc = TranslationHelper::translateText("Experience timeless elegance with Desio's Timeless Collection, ideal for achieving a subtle, natural eye color. Tailored for dark brown eyes, our collection satisfies your desire for darker lenses that seamlessly blend with your natural eye color. What sets this collection apart is the 14.2 lens diameter, a feature sought after by many of our customers.", $preferredLanguage);
$firstAttrOne = TranslationHelper::translateText("Diameter: 14.2mm - Base curve 8.6mm", $preferredLanguage);
$firstAttrTwo = TranslationHelper::translateText("Availability: From -8.00 to +4.00", $preferredLanguage);

$discoBtn = TranslationHelper::translateText("Discover the Collection: From -8.00 to +4.00", $preferredLanguage);
@endphp
<div class="container">
    <a href="{{ route('ego.index') }}">{{$homeUrl}}</a>
    <h1 class="text-center" style="font-size: 5rem">{{$aboutTitle}}</h1>
    <p class="text-center">{{$aboutText}}</p>
    <div class="row align-items-center all  ">
        <div class="col-md-8">
            <img src="https://www.desiolens.com/media/wysiwyg/Topmenu_-color_SBL13.jpg" class="img-fluid" alt="Timeless Collection">
        </div>
        <div class="col-md-4 abouMode">
            <div class="p-5 mt-2">
                <h1>{{$firstTitle}}</h1>
                <h6>{{$firstSubTitle}}</h6>
                <p>{{$firstDesc}}</p>
                <small>{{$firstAttrOne}}</small>
                <small>{{$firstAttrTwo}}</small> <br>
                <a href="#" class="mt-5 text-black">{{$discoBtn}} <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container allLense">
    <div class="row align-items-center" style="background: #f5f5f5;">

        <div class="col-md-6 allLense">
            <div class="p-5 mt-2">
            <h1>{{$firstTitle}}</h1>
                <h6>{{$firstSubTitle}}</h6>
                <p>{{$firstDesc}}</p>
                <small>{{$firstAttrOne}}</small>
                <small>{{$firstAttrTwo}}</small> <br>
                <a href="#" class="mt-5 text-black">{{$discoBtn}} <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-md-6 allLens">
            <img src="https://www.desiolens.com/media/wysiwyg/romanticblue.jpg" class="img-fluid" alt="Timeless Collection">
        </div>
    </div>
</div>

@endsection