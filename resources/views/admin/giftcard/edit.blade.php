@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user.gift.update',$giftCard->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Code</label>
                            <input type="text" class="form-control" name="code" value="{{$giftCard->code}}"
                                placeholder="please enter code....">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>Initial Balance</label>
                            <input type="number" class="form-control" name="balance"
                                placeholder="please enter balance...." value="{{$giftCard->initial_balance}}">
                            @error('balance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>Current Balance</label>
                            <input type="number" class="form-control" name="balance_now"
                                placeholder="please enter balance...." value="{{$giftCard->balance}}">
                            @error('balance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>Expiry Date ({{ $giftCard->expiry_date }})</label>
                            <input type="date" class="form-control" name="expiry_date"
                                   placeholder="please enter expiry date...." 
                                   value="{{ $giftCard->expiry_date }}">
                            @error('expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" @if($giftCard->is_active == '1') selected @endif>Active</option>
                                <option value="0" @if($giftCard->is_active == '0') selected @endif>Inactive</option>
                            </select>
                            @error('expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        

                        <div class="form-group col-6">
                            <label>Cutoff percentage</label>
                            <input type="number" class="form-control" name="cutoff_percentage"
                                placeholder="please enter cutoff percentage...." value="{{$giftCard->cutoff_percentage}}">
                            @error('cutoff_percentage')
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
