@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('category.view') }}" class="text-decoration-none btn btn-primary">Category
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-5">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="name"
                            placeholder="please enter category name...." value="{{ $category->name }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Category Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                name="category_image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                            @error('category_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="imagePreview" style="margin-top: 10px;">
                            @if($category->thumbnail)
                            <img src="{{asset($category->thumbnail)}}" style="width: 200px; height: auto;" alt="" srcset="">
                            @endif
                        </div>

                    </div>
                    <div class="form-group col-12">
                        <label for="">Category Description</label>
                        <textarea name="category_description" class="form-control" id="editor1">{!! $category->description !!}</textarea>
                        @error('product_intro')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
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