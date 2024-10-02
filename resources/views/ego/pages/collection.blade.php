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
<div class="container">
    <a href="{{ route('ego.index') }}">Home</a>
    <h1 class="text-center" style="font-size: 5rem">@lang('messages.Collections')</h1>
    <p class="text-center">Discover Ego Vision's exquisite collection of colored contact lenses, renowned for being the top choice for dark eyes and thoughtfully crafted to enhance your natural eye beauty. Explore our range to find unique designs that suit your style. Whether you're looking for hazel, grey, blue, or green lenses, we have something for everyone. We also offer prescription colored contact lenses, with select collections designed for individuals with astigmatism.</p>
</div>
<br>
<div class="container">
    @foreach($collectionSets as $collectionSet)
    <div class="row align-items-center" style="background: #f5f5f5;">
        <div class="col-md-8">
            <img src="{{asset($collectionSet->image_path)}}" class="img-fluid" alt="Timeless Collection">
        </div>
        <div class="col-md-4">
            <div class="p-5 mt-2">
                <h1>{{$collectionSet->category->name}}</h1>
                <h4>
                    {{ $collectionSet->tone ? $collectionSet->tone->name : '' }}
                    {{ $collectionSet->duration ? '- ' . $collectionSet->duration->name : '' }}
                </h4>

                {!! $collectionSet->description !!}
                <br>
                <a href="{{ route('collectionSet.single.collection', $collectionSet->id) }}" class="mt-5 text-black">Discover the Collection <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    @endforeach

</div>

@endsection