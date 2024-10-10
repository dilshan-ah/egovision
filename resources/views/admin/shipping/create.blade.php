@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('shipping.index') }}" class="text-decoration-none btn btn-primary">Shipping
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('shipping.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Please enter title...">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Place</label>
                        <input type="text" class="form-control" name="place" value="{{ old('place') }}" placeholder="Please enter place name...">
                        @error('place')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Fee</label>
                        <input type="number" class="form-control" name="fee" value="{{ old('fee') }}" placeholder="Please enter fee amount...">
                        @error('fee')
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