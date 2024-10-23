@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('insta.user.update',$insta->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="please enter name...." value="{{$insta->name}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>Access Token</label>
                            <input type="text" class="form-control" name="access_token"
                                placeholder="please enter access token...." value="{{$insta->access_token}}">
                            @error('access_token')
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
