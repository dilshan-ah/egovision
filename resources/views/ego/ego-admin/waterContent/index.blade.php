@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('water_content.create') }}" class="text-decoration-none btn btn-primary">Add Water Content</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Water Content</th>
                                <th>Creation Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($water_contents as $key => $water_content)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration + ($water_contents->currentPage() - 1) * $water_contents->perPage() }}
                                    </td>
                                    <td>{{ $water_content->name }}</td>
                                    <td>{{ $water_content->created_at->format('m/d/Y g:i A') }}</td>
                                    <td>
                                        <a href="{{ route('water_content.edit', $water_content->id) }}"
                                            class="btn btn-secondary btn-xs">Edit</a>
                                        <a href="{{ route('water_content.delete', $water_content->id) }}"
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
