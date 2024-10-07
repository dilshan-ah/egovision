@extends('admin.layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('collectionSet.view') }}" class="text-decoration-none btn btn-primary">Collection Set
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('collectionSet.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-4">
                        <label>Select Category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label>Select Tones</label>
                        <select name="tone_id" class="form-control">
                            <option value="">--Select Tone--</option>
                            @foreach($tones as $tone)
                            <option value="{{ $tone->id }}" {{ old('tone_id') == $tone->id ? 'selected' : '' }}>
                                {{ $tone->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('tone_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-4">
                        <label>Select Duration</label>
                        <select name="duration_id" class="form-control">
                            <option value="">--Select Duration--</option>
                            @foreach($durations as $duration)
                            <option value="{{ $duration->id }}" {{ old('duration_id') == $duration->id ? 'selected' : '' }}>
                                {{ $duration->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('duration_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-4">
                        <label>Show in dashboard ?</label>
                        <select name="featured" class="form-control">
                            <option value="yes" {{ old('featured') == 'yes' ? 'selected' : '' }}>yes</option>
                            <option value="no" {{ old('featured') == 'no' ? 'selected' : '' }}>no</option>
                        </select>
                        @error('featured')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="">Collection Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="collection_image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                            @error('collection_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="imagePreview" style="margin-top: 10px;"></div>
                    </div>

                    <div class="form-group col-12">
                        <label for="">Collection Description</label>
                        <textarea name="collection_description" class="form-control" id="editor1">{{ old('collection_description') }}</textarea>
                        @error('collection_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
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

    });
</script>
@endpush