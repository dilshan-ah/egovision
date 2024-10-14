@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <div class="d-flex">
                <h6 class="m-0 mr-4"><a href="{{ route('product.create') }}" class="text-decoration-none btn btn-primary">Add
                        Lens</a>
                </h6>
                <h6 class="m-0"><a href="{{ route('product.create.accessories') }}" class="text-decoration-none btn btn-primary">Add
                        Accessories</a>
                </h6>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Products Name</th>
                            <th>Price</th>
                            <th>Creation Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        <tr class="text-center">
                            <td>{{ $products->firstItem() + $key }}
                            </td>
                            <td>
                                <img src="{{asset($product->image_path)}}" width="200px" alt="">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{$product->price}} ৳</td>
                            <td>{{ $product->created_at->format('m/d/Y g:i A') }}</td>
                            <td>
                                <a href="{{ route('product.edit', $product->id) }}"
                                    class="btn btn-secondary btn-xs">Edit</a>
                                <a href="{{ route('product.delete', $product->id) }}"
                                    class="btn btn-danger btn-xs">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($products->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($products) }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('breadcrumb-plugins')
<div class="mb-2"><x-search-form placeholder="Product name/Price" /></div>
@endpush