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
$homeUrl = TranslationHelper::translateText('Home', $preferredLanguage);
$durationPageTitle = TranslationHelper::translateText('Lens Duration', $preferredLanguage);
$durationPageSubTitle = TranslationHelper::translateText("Choosing between Monthly and Quarterly colored contact Lenses: What's best for you?", $preferredLanguage);
$durationPageDesc = TranslationHelper::translateText("Deciding between monthly and quarterly colored contact lenses depends on several factors, including lifestyle, budget, and specific eye health needs. Monthly color contact lenses are ideal for those seeking maximum comfort and hydration, while quarterly lenses (three months) appeal to those valuing convenience and less frequent maintenance. When enhancing your vision with colored contact lenses, selecting the right type and material is crucial for finding the most comfortable contact lenses and ensuring your eye safety. We provide detailed comparisons and expert advice on both monthly and quarterly lenses, as well as prescription color contact lenses and colored contacts for astigmatism, catering to diverse lifestyles. Let's delve into understanding the materials, Hioxifilcon D and Polymacon, in the sections below.", $preferredLanguage);

$discoverBtn = TranslationHelper::translateText('Discover the Collection', $preferredLanguage);
@endphp
<div class="container">
    <a href="{{ route('ego.index') }}">{{$homeUrl}}</a>
    <h1 class="text-center" style="font-size: 5rem">{{$durationPageTitle}}</h1>
    <h4 class="text-center">{{$durationPageSubTitle}}</h4>
    <p>
        {{$durationPageDesc}}
    </p>

    @foreach($durations as $duration)
    <div class="row align-items-center" style="background: #f5f5f5;">
        <div class="col-md-6 duationMode">
            <a href="{{route('duration.single.duration',$duration->id)}}">
                <img src="{{asset($duration->image_path)}}" style="width: 100%;" class="img-fluid" alt="Timeless Collection">
            </a>
        </div>
        <div class="col-md-6 duationMode">
            <div class="p-5 mt-2">
                <h1>{{$duration->name}}</h1>
                {!! $duration->description !!} <br>
                <a href="{{route('duration.single.duration',$duration->id)}}" class="mt-5 text-black">{{$discoverBtn}} <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <br>
    @endforeach

</div>

@endsection