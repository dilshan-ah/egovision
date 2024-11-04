@extends('layouts.app')
@section('content')

@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$uploadTitle = TranslationHelper::translateText('Upload Prescription', $preferredLanguage);
$uploadText = TranslationHelper::translateText('To recover your account please provide your email or username to find your account.', $preferredLanguage);
$prescriptionLabel = TranslationHelper::translateText('Prescription File', $preferredLanguage);
$submitBtn = TranslationHelper::translateText('Submit', $preferredLanguage);

$presFile = TranslationHelper::translateText('Prescription File', $preferredLanguage);
$noPres = TranslationHelper::translateText('No prescription uploaded.', $preferredLanguage);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4 text-dark">{{ $uploadTitle }}</h2>
            <div class="mb-4">
                <p>{{$uploadText}}</p>
            </div>
            <form method="POST" action="{{ route('user.upload.prescription.submit') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">{{$prescriptionLabel}}</label>
                    <input type="file" class="form-control " name="file" value="{{ old('value') }}" required autofocus="off">
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark w-100">{{$submitBtn}}</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>{{$presFile}}</h3>
                </div>
                <div class="card-body">
                    @if ($pres)
                    <iframe src="{{ asset($pres) }}" style="width: 100%; height: 600px;" frameborder="0"></iframe>
                    @else
                    <p>{{$noPres}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection