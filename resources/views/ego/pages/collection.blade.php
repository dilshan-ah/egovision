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
$collectionPageTitle = TranslationHelper::translateText('Collection', $preferredLanguage);
$collectionPageDesc = TranslationHelper::translateText("Discover Ego Vision's exquisite collection of colored contact lenses, renowned for being the top choice for dark eyes and thoughtfully crafted to enhance your natural eye beauty. Explore our range to find unique designs that suit your style. Whether you're looking for hazel, grey, blue, or green lenses, we have something for everyone. We also offer prescription colored contact lenses, with select collections designed for individuals with astigmatism.", $preferredLanguage);

$discoverBtn = TranslationHelper::translateText('Discover the Collection', $preferredLanguage);
@endphp

<div class="container">
    <a href="{{ route('ego.index') }}">{{$homeUrl}}</a>
    <h1 class="text-center" style="font-size: 5rem">{{$collectionPageTitle}}</h1>
    <p class="text-center">{{$collectionPageDesc}}</p>
</div>
<br>
<div class="container collectionMode">
    @foreach($collectionSets as $collectionSet)
    <div class="row align-items-center">
        <div class="col-md-6 collectionMode">
            <a href="{{ route('collectionSet.single.collection', $collectionSet->id) }}">
                <img src="{{asset($collectionSet->image_path)}}" class="img-fluid" alt="Timeless Collection">
            </a>
        </div>
        <div class="col-md-6 collectionMode">
            <div class="p-5 mt-2">
                <h1>{{$collectionSet->category->name}}</h1>
                <h4>
                    {{ $collectionSet->tone ? $collectionSet->tone->name : '' }}
                    {{ $collectionSet->duration ? '- ' . $collectionSet->duration->name : '' }}
                </h4>

                {!! $collectionSet->description !!}
                <br>
                <a href="{{ route('collectionSet.single.collection', $collectionSet->id) }}" class="mt-5 text-black">{{$discoverBtn}} <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    @endforeach

</div>

@endsection