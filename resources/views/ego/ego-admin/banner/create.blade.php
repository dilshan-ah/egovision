@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('banner.view') }}" class="text-decoration-none btn btn-primary">Banner
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-12">
                        <div id="imagePreview" style="margin-top: 10px;"></div>
                        <label for="">Banner Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                name="banner_image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                            @error('banner_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group col-12">
                        <label>Select Product</label>
                        <select name="product_id" class="form-control">
                            @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Banner Title</label>
                        <input type="text" class="form-control" name="banner_title">
                    </div>

                    <div class="form-group col-6">
                        <label>Button Text</label>
                        <input type="text" class="form-control" name="btn_text">
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
<script>
    $(document).ready(function() {

        $('#inputGroupFile01').on('change', function() {
            var file = this.files[0];
            if (file) {
                $(this).next('.custom-file-label').html(file.name);
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').html('<img src="' + e.target.result +
                        '" alt="Selected Image" style="width: 400px; height: auto;">');
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