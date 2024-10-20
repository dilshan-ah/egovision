@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('banner.create') }}" class="text-decoration-none btn btn-primary">Create
                    Banner</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Banner Image</th>
                            <th>Related Product</th>
                            <th>Creation Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $key => $banner)
                        <tr>
                            <td>{{ $loop->iteration }}
                            </td>
                            <td>
                                <img src="{{asset($banner->banner_path)}}" style="width:250px" alt="">
                            </td>
                            <td>
                                {{@$banner->product->name}}
                            </td>
                            <td>{{ $banner->created_at->format('m/d/Y g:i A') }}</td>
                            <td>
                                <a href="{{ route('banner.edit', $banner->id) }}"
                                    class="btn btn-secondary btn-xs">Edit</a>
                                <a href="{{ route('banner.delete', $banner->id) }}"
                                    class="btn btn-danger btn-xs">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection