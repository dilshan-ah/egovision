@extends('admin.layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('product.index') }}" class="text-decoration-none btn btn-primary">Product List</a></h6>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-3">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Pack Content</label>
                        <input type="text" class="form-control" name="pack_content">
                        @error('pack_content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Diameter</label>
                        <select name="diameter_id" class="form-control">
                            <option value="" selected>Select Diameter</option>
                            @foreach ($diameters as $diameter)
                            <option value="{{ $diameter->id }}">{{ $diameter->name }}</option>
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
                            <option value="{{ $base->id }}">{{ $base->name }}</option>
                            @endforeach
                        </select>
                        @error('base_curve_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Material</label>
                        <select name="material_id" class="form-control">
                            <option value="" selected>Select Material</option>
                            @foreach ($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                            @endforeach
                        </select>
                        @error('material_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Water Content</label>
                        <select name="water_content_id" class="form-control">
                            <option value="" selected>Select Water Content</option>
                            <option value="water content">water content</option>
                        </select>
                        <!-- @error('water_content_id') -->
                        <!-- <span class="text-danger">{{ $message }}</span> -->
                        <!-- @enderror -->
                    </div>
                    <div class="form-group col-3">
                        <label for="">Tones</label>
                        <select name="tone_id" class="form-control">
                            <option value="" selected>Select Tones</option>
                            @foreach ($tones as $tone)
                            <option value="{{ $tone->id }}">{{ $tone->name }}</option>
                            @endforeach
                        </select>
                        @error('tone_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Lens Design</label>
                        <select name="lens_design_id" class="form-control">
                            <option value="" selected>Select Lens Design</option>
                            @foreach ($lDesigns as $lDesign)
                            <option value="{{ $lDesign->id }}">{{ $lDesign->name }}</option>
                            @endforeach
                        </select>
                        @error('lens_design_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Stock Quantity</label>
                        <input type="number" class="form-control" name="stock_quantity">
                        @error('stock_quantity')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Choose Color</label>
                        <select name="color_id" class="form-control">
                            <option value="" selected>Pick Color</option>
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                        @error('color_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Choose Duration</label>
                        <select name="duration_id" class="form-control">
                            <option value="" selected>Pick Duration</option>
                            @foreach ($durations as $duration)
                            <option value="{{ $duration->id }}">{{ $duration->name }}-( {{$duration->months}} {{$duration->months == 1 ? 'month':'months'}} )</option>
                            @endforeach
                        </select>
                        @error('duration_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Category</label>
                        <select name="category_id" class="form-control">
                            <option value="" selected>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Type</label>
                        <select name="product_type" class="form-control">
                            <option value="" selected>Select Product Type</option>
                            <option value="normal">Lens</option>
                            <option value="accessories">Accessories</option>
                        </select>
                        @error('product_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Introduction</label>
                        <textarea name="product_intro" class="form-control" id="editor1"></textarea>
                        @error('product_intro')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Description</label>
                        <textarea name="description" class="form-control" id="editor2"></textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="product_image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                            @error('product_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="imagePreview" style="margin-top: 10px;"></div>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Image Album</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="product_image_album[]" accept="image/*" multiple>
                            <label class="custom-file-label fileLabel" for="inputGroupFile02">Choose Image</label>
                            @error('product_image_album')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('product_image_album.*')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="imagePreview2" style="margin-top: 10px;"></div>
                    </div>

                    <div class="col-12 mb-5">
                        <div class="row">
                            <label for="" class="col-6">Add available powers</label>
                            <label for="" class="col-6">Set stock quantity</label>
                        </div>

                        <div id="variation-container">
                            <div class="row variation-group">
                                <div class="col-5 form-group
<label for="">Powers</label>
                                    <input type=" text" class="form-control" name="powers[]" placeholder="e.g. -1.00">
                                </div>
                                <div class="col-5 form-group">
                                    <label for="">Stock Quantity</label>
                                    <input type="number" class="form-control" name="powers_quantity[]" placeholder="e.g. 10">
                                </div>
                                <div class="col-2 form-group mt-4">
                                    <button type="button" class="btn btn-danger remove-variation">Remove</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success add-variation">Add More Powers</button>
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('ego-assets/js/jodit.min.js') }}"></script>
<script>
    const editor1 = new Jodit("#editor1", {
        // Your Jodit editor options here
    });
    const editor2 = new Jodit("#editor2", {
        // Your Jodit editor options here
    });

    document.querySelector('.add-variation').addEventListener('click', function() {
        const variationGroup = document.querySelector('.variation-group');
        const newVariation = variationGroup.cloneNode(true);
        newVariation.querySelectorAll('input').forEach(input => input.value = ''); // Clear input values
        document.getElementById('variation-container').appendChild(newVariation);
    });

    document.getElementById('variation-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-variation')) {
            const variationGroup = e.target.closest('.variation-group');
            variationGroup.remove();
        }
    });

    document.querySelector('#inputGroupFile01').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '100px'; // Adjust as needed
            img.style.height = '100px'; // Adjust as needed
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });

    document.querySelector('#inputGroupFile02').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview2');
        preview.innerHTML = '';
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px'; // Adjust as needed
                img.style.height = '100px'; // Adjust as needed
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });
</script>

@endsection