@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <h6 class="m-0"><a href="{{ route('user.gift.index') }}" class="text-decoration-none btn btn-primary">Gift Card
                        List</a>
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user.gift.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Code</label>
                            <input type="text" class="form-control" name="code"
                                placeholder="please enter code....">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>Balance</label>
                            <input type="number" class="form-control" name="balance"
                                placeholder="please enter balance....">
                            @error('balance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>Expiry date</label>
                            <input type="date" class="form-control" name="expiry_date"
                                placeholder="please enter expiry date....">
                            @error('expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>Cutoff percentage</label>
                            <input type="number" class="form-control" name="cutoff_percentage"
                                placeholder="please enter cutoff percentage....">
                            @error('cutoff_percentage')
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
