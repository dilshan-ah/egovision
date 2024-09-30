@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('category.create') }}" class="text-decoration-none btn btn-primary">Create
                    Category</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Creation Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                        <tr class="text-center">
                            <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('m/d/Y g:i A') }}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}"
                                    class="btn btn-secondary btn-xs">Edit</a>
                                <a href="{{ route('category.delete', $category->id) }}"
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