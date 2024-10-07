@extends('admin.layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('product.accessories') }}" class="text-decoration-none btn btn-primary">Accessory
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('product.update.accessory',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-3">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $product->name)}}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Pack Content</label>
                        <input type="text" class="form-control" name="pack_content" value="{{ old('pack_content', $product->pack_content) }}">
                        @error('pack_content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Diameter</label>
                        <select name="diameter_id" class="form-control">
                            <option value="" selected>Select Diameter</option>
                            @foreach ($diameters as $diameter)
                            <option value="{{ $diameter->id }}" {{ old('diameter_id', $product->diameter_id) == $diameter->id ? 'selected' : '' }}>{{ $diameter->name }}</option>
                            @endforeach
                        </select>
                        @error('diameter_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Base Curve</label>
                        <select name="base_curve_id" class="form-control">
                            <option value="" selected>Select Base Curve</option>
                            @foreach ($bases as $base)
                            <option value="{{ $base->id }}" {{ old('base_curve_id', $product->base_curve_id) == $base->id ? 'selected' : '' }}>{{ $base->name }}</option>
                            @endforeach
                        </select>
                        @error('base_curve_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price" min=1 value="{{ old('price', $product->price) }}">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Choose Duration</label>
                        <select name="duration_id" class="form-control">
                            <option value="" selected>Pick Duration</option>
                            @foreach ($durations as $duration)
                            <option value="{{ $duration->id }}" {{ old('duration_id', $product->duration_id) == $duration->id ? 'selected' : '' }}>{{ $duration->name }}-( {{$duration->months}} {{$duration->months == 1 ? 'month':'months'}} )</option>
                            @endforeach
                        </select>
                        @error('duration_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Is Free?</label>
                        <select name="is_free" class="form-control">
                            <option value="1" {{ old('is_free') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_free') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Is Default? (you can only keep one default)</label>
                        <select name="is_default" class="form-control">
                            <option value="" {{ old('is_default', $product->is_default) === null ? 'selected' : '' }}>set yes if you want it default</option>
                            <option value="1" {{ old('is_default', $product->is_default) == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_default', $product->is_default) == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Introduction</label>
                        <textarea name="product_intro" class="form-control" id="editor1">{{ old('product_intro', $product->product_intro) }}</textarea>
                        @error('product_intro')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Description</label>
                        <textarea name="description" class="form-control" id="editor2">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                name="product_image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                            @error('product_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="imagePreview" style="margin-top: 10px;">
                            <img src="{{asset($product->image_path)}}" alt="Selected Image" style="width: 200px; height: auto;">
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Image Album</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02"
                                name="product_image_album[]" accept="image/*" multiple>
                            <label class="custom-file-label fileLabel" for="inputGroupFile02">Choose Image</label>
                            @error('product_image_album')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('product_image_album.*')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="imagePreview2" style="margin-top: 10px;">
                            @foreach($product->images as $image)
                            <img src="{{asset($image->image_path)}}" alt="Selected Image" style="width: 200px; height: auto; margin-right: 10px; margin-bottom: 10px;">
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('ego-assets/js/jodit.fat.min.js') }}"></script>
<script>
    $(document).ready(function() {
        const editor1 = new Jodit('#editor1', {
            toolbarAdaptive: false,
            toolbarSticky: true,
            height: 300,
        });

        const editor2 = new Jodit('#editor2', {
            toolbarAdaptive: false,
            toolbarSticky: true,
            height: 300,
        });

        $('#inputGroupFile01').on('change', function() {
            var file = this.files[0];
            if (file) {
                $(this).next('.custom-file-label').html(file.name);
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').html('<img src="' + e.target.result +
                        '" alt="Selected Image" style="width: 200px; height: auto;">');
                }
                reader.readAsDataURL(file);
            } else {
                $(this).next('.custom-file-label').html('Choose file');
                $('#imagePreview').html('');
            }
        });

        $('#inputGroupFile02').on('change', function() {
            var files = this.files;
            var $imagePreview = $('#imagePreview2');
            $imagePreview.html(''); // Clear previous images

            if (files.length > 0) {
                $(this).next('.fileLabel').html(files.length + ' images selected');
                Array.from(files).forEach(function(file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $imagePreview.append('<img src="' + e.target.result +
                            '" alt="Selected Image" style="width: 200px; height: auto; margin-right: 10px; margin-bottom: 10px;">'
                        );
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                $(this).next('.fileLabel').html('Choose Images');
            }
        });
    });
</script>



@endpush