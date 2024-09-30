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
    <a href="index.html">Home</a>
    <h1 class="text-center" style="font-size: 5rem">Color</h1>
    <p class="text-center">Looking for top-quality colored contact lenses to enhance your natural eye color or completely revamp your look? Explore the incredible range at egovision.shop
Our website features a stunning collection of premium color contact lenses in a wide variety of shades and styles. Whether you prefer a subtle enhancement or a bold, standout appearance, we have the perfect lenses to match your desired look. Crafted from the highest quality materials, our lenses are designed for maximum comfort and safety. With various shades available, you can choose the level of color intensity that suits you best.
Our customer service team is always ready to assist with any questions. Why wait? Discover the perfect Ego Vision colored contact lenses today and instantly transform your style!
</p>

    @foreach ($colors as $color)
    <div class="row align-items-center" style="background: #f5f5f5;">
        <div class="col-md-8">
            <img src="{{ asset($color->image_path) }}" class="img-fluid" alt="Timeless Collection">
        </div>
        <div class="col-md-4">
            <div class="p-5 mt-2">
                <h1>{{ $color->name }}</h1>
                {!! $color->color_intro !!}
                <a href="{{route('color.single.color',$color->id)}}" class="mt-5 text-black">Discover the Collection <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div><br>
    @endforeach
</div>
@endsection