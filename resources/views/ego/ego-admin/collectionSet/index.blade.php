@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('collectionSet.create') }}" class="text-decoration-none btn btn-primary">Create
                    Collection Set</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Set Name</th>
                            <th>Showing in dashboard?</th>
                            <th>Creation Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collectionSets as $collectionSet)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                            {{$collectionSet->category->name}}
                                @if($collectionSet->tone) - {{$collectionSet->tone->name}} @endif
                                @if($collectionSet->duration) - {{$collectionSet->duration->name}} @endif

                            </td>
                            <td>{{$collectionSet->featured}}</td>
                            <td>{{ $collectionSet->created_at->format('m/d/Y g:i A') }}</td>
                            <td>
                                <a href="{{ route('collectionSet.edit', $collectionSet->id) }}"
                                    class="btn btn-secondary btn-xs">Edit</a>
                                <a href="{{ route('collectionSet.delete', $collectionSet->id) }}"
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