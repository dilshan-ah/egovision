@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/jodit.fat.min.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <h6 class="m-0"><a href="{{ route('promo.index') }}" class="text-decoration-none btn btn-primary">Promo Code
                    List</a>
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('promo.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label>Note</label>
                        <input type="text" class="form-control" name="note" value="{{ old('note') }}" placeholder="Please enter note...">
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Reedem Code</label>
                        <input type="text" class="form-control" name="reedem_code" value="{{ old('reedem_code') }}" placeholder="Please enter reedem code...">
                        @error('reedem_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Offer Type</label>
                        <select name="offer_type" id="" class="form-control">
                            <option value="product-offer" {{ old('offer_type') == 'product-offer' ? 'selected' : '' }}>Product Offer</option>
                            <option value="deliver-offer" {{ old('offer_type') == 'deliver-offer' ? 'selected' : '' }}>Delivery Offer</option>
                        </select>
                        @error('offer_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Free Delivery</label>
                        <select name="free_delivery" id="" class="form-control">
                            <option value="yes" {{ old('free_delivery') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('free_delivery') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('free_delivery')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Offer amount (in percent)</label>
                        <input type="number" class="form-control" name="offer_amount" value="{{ old('offer_amount') }}" placeholder="Please enter offer amount..." max="100">
                        @error('offer_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Min Amount</label>
                        <input type="number" class="form-control" name="min_amount" value="{{ old('min_amount') }}" placeholder="Please enter min amount...">
                        @error('min_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label>Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
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