@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('replacement.create') }}"
                        class="text-decoration-none btn btn-primary">Create
                        Replacement</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Replacement Name</th>
                                <th>Creation Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($replacements as $key => $replacement)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration + ($replacements->currentPage() - 1) * $replacements->perPage() }}
                                    </td>
                                    <td>{{ $replacement->name }}</td>
                                    <td>{{ $replacement->created_at->format('m/d/Y g:i A') }}</td>
                                    <td>
                                        <a href="{{ route('replacement.edit', $replacement->id) }}"
                                            class="btn btn-secondary btn-xs">Edit</a>
                                        <a href="{{ route('replacement.delete', $replacement->id) }}"
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
