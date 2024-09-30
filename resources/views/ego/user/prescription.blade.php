@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-7 col-xl-5">
            <div class="card ">
                <div class="card-header bg-primary">
                    <h5 class="card-title text-white">{{ __($pageTitle) }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <p>@lang('To recover your account please provide your email or username to find your account.')</p>
                    </div>
                    <form method="POST" action="{{ route('user.upload.prescription.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">@lang('Prescription File')</label>
                            <input type="file" class="form-control " name="file" value="{{ old('value') }}" required autofocus="off">
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Prescription File</h3>
                </div>
                <div class="card-body">
                    @if ($pres)
                    <iframe src="{{ asset($pres) }}" style="width: 100%; height: 600px;" frameborder="0"></iframe>
                    @else
                    <p>No prescription uploaded.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection