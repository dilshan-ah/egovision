@extends('admin.layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('product.index') }}" class="text-decoration-none btn btn-primary">Product
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-3">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Pack Content</label>
                        <input type="text" class="form-control" name="pack_content" value="{{ old('pack_content') }}">
                        @error('pack_content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Diameter</label>
                        <select name="diameter_id" class="form-control">
                            <option value="" selected>Select Diameter</option>
                            @foreach ($diameters as $diameter)
                            <option value="{{ $diameter->id }}" {{ old('diameter_id') == $diameter->id ? 'selected' : '' }}>{{ $diameter->name }}</option>
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
                            <option value="{{ $base->id }}" {{ old('base_curve_id') == $base->id ? 'selected' : '' }}>{{ $base->name }}</option>
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
                            <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>{{ $material->name }}</option>
                            @endforeach
                        </select>
                        @error('material_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Water Content</label>
                        <input type="text" class="form-control" name="water_content" value="{{ old('water_content') }}" placeholder="Enter Water content">
                        @error('water_content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Tones</label>
                        <select name="tone_id" class="form-control">
                            <option value="" selected>Select Tones</option>
                            @foreach ($tones as $tone)
                            <option value="{{ $tone->id }}" {{ old('tone_id') == $tone->id ? 'selected' : '' }}>{{ $tone->name }}</option>
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
                            <option value="{{ $lDesign->id }}" {{ old('lens_design_id') == $lDesign->id ? 'selected' : '' }}>{{ $lDesign->name }}</option>
                            @endforeach
                        </select>
                        @error('lens_design_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">No Power Price</label>
                        <input type="number" class="form-control" name="no_power_price" value="{{old('no_power_price')}}" min=1>
                        @error('no_power_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">With Power Price</label>
                        <input type="number" class="form-control" name="price" min=1 value="{{old('price')}}">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label for="">Choose Color</label>
                        <select name="color_id" class="form-control">
                            <option value="" selected>Pick Color</option>
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
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
                            <option value="{{ $duration->id }}" {{ old('duration_id') == $duration->id ? 'selected' : '' }}>{{ $duration->name }}-( {{$duration->months}} {{$duration->months == 1 ? 'month':'months'}} )</option>
                            @endforeach
                        </select>
                        @error('duration_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="">Product Category</label>
                        <select name="category_id" class="form-control">
                            <option value="" selected>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Introduction</label>
                        <textarea name="product_intro" class="form-control" id="editor1">{{ old('product_intro') }}</textarea>
                        @error('product_intro')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Product Description</label>
                        <textarea name="description" class="form-control" id="editor2">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6 mb-5">
                        <h4 class="mb-2">Choose Available powers</h4>
                        <div class="row ml-2">
                            <div class="form-group col-12 d-flex">
                                <label for="available_power_1">-0.25 to -6.00</label>
                                <input type="checkbox" class="form-check-input" value="(-0.25-6.00)" id="available_power_1"
                                    name="available_powers[]"
                                    {{ in_array('(-0.25-6.00)', old('available_powers', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="form-group col-12 d-flex">
                                <label for="available_power_2">-6.50 to -10.00</label>
                                <input type="checkbox" class="form-check-input" value="(-6.50-10.00)" id="available_power_2"
                                    name="available_powers[]"
                                    {{ in_array('(-6.25-10.00)', old('available_powers', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="form-group col-12 d-flex">
                                <label for="available_power_3">+0.25 to +6.00</label>
                                <input type="checkbox" class="form-check-input" value="(+0.25+6.00)" id="available_power_3"
                                    name="available_powers[]"
                                    {{ in_array('(+0.25+6.00)', old('available_powers', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="form-group col-12 d-flex">
                                <label for="available_power_4">+6.50 to +10.00</label>
                                <input type="checkbox" class="form-check-input" value="(+6.50+10.00)" id="available_power_4"
                                    name="available_powers[]"
                                    {{ in_array('(+6.25+10.00)', old('available_powers', [])) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Lens Parameter</label>
                        <textarea name="lensparameter" class="form-control" id="editor3">{{ old('description') }}</textarea>
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
                        <div id="imagePreview" style="margin-top: 10px;"></div>
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
                        <div id="imagePreview2" style="margin-top: 10px;"></div>
                    </div>


                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
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

        const editor3 = new Jodit('#editor3', {
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

<script>
    $(document).ready(function() {
        // Function to update JSON field
        function updateJSON() {
            var variations = [];

            // Iterate over each variation-group
            $('#variation-container .variation-group').each(function() {
                var power = $(this).find('.power').val();
                var stock = $(this).find('.stock').val();

                // Only add to JSON if both fields are filled
                if (power && stock) {
                    variations.push({
                        power: power,
                        stock: stock
                    });
                }
            });

            // Update the hidden input with the JSON string
            $('#variations_json').val(JSON.stringify(variations));
        }

        // Handle adding new variation-group
        $('#add-more').click(function() {
            var newGroup = $('.variation-group:first').clone();

            // Clear the values in the cloned group
            newGroup.find('select').val('');
            newGroup.find('input').val('');

            // Append the new group to the container
            newGroup.appendTo('#variation-container');

            // Attach remove event to new remove button
            newGroup.find('.remove-variation').click(function() {
                $(this).closest('.variation-group').remove();
                updateJSON();
            });

            updateJSON();
        });

        // Attach remove event to initial remove button
        $('.remove-variation').click(function() {
            $(this).closest('.variation-group').remove();
            updateJSON();
        });

        // Update JSON on input change
        $('#variation-container').on('change', '.power, .stock', function() {
            updateJSON();
        });

        // Initialize JSON field on page load
        updateJSON();
    });
</script>

@endpush