@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('baseCurve.index') }}" class="text-decoration-none btn btn-primary">Base Curve
                        List</a>
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('baseCurve.update', $bases->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-5">
                            <label>Base Curve Name</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="please enter Base Curve name...." value="{{ $bases->name }}">
                            @error('name')
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
