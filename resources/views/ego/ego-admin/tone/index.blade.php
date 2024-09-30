@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('tone.create') }}" class="text-decoration-none btn btn-primary">Create
                        Tone</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tone Name</th>
                                <th>Creation Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tones as $key => $tone)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration + ($tones->currentPage() - 1) * $tones->perPage() }}
                                    </td>
                                    <td>{{ $tone->name }}</td>
                                    <td>{{ $tone->created_at->format('m/d/Y g:i A') }}</td>
                                    <td>
                                        <a href="{{ route('tone.edit', $tone->id) }}"
                                            class="btn btn-secondary btn-xs">Edit</a>
                                        <a href="{{ route('tone.delete', $tone->id) }}"
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
