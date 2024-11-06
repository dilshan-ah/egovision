@extends('layouts.app')
@section('content')
<style>
    .form-control {
        border-bottom: 1px solid black !important;
        background-color: transparent !important;
        border-top: 0 !important;
        border-left: 0 !important;
        border-right: 0 !important;
        margin-bottom: 50px !important;
        margin-top: 0px !important;
        border-radius: 0 !important;
        outline: 0 !important;
        padding: 12px 0px !important;
    }

    .form-label{
        font-size: 0.6875rem;
        color: rgba(0, 0, 0, 0.3);
    }
</style>
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$profileTitle = TranslationHelper::translateText('Profile', $preferredLanguage);

$firstName = TranslationHelper::translateText('First Name', $preferredLanguage);
$lastName = TranslationHelper::translateText('Last Name', $preferredLanguage);
$email = TranslationHelper::translateText('E-mail Address', $preferredLanguage);
$phone = TranslationHelper::translateText('Mobile Number', $preferredLanguage);
$address = TranslationHelper::translateText('Address', $preferredLanguage);
$state = TranslationHelper::translateText('State', $preferredLanguage);
$zip = TranslationHelper::translateText('Zip Code', $preferredLanguage);
$city = TranslationHelper::translateText('City', $preferredLanguage);
$country = TranslationHelper::translateText('Country', $preferredLanguage);
$submitbtn = TranslationHelper::translateText('Submit', $preferredLanguage);
@endphp
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-4 text-dark">{{$profileTitle}}</h2>
            <form class="register" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="form-label">{{$firstName}}</label>
                        <input type="text" class="form-control d-flex w-100" name="firstname" value="{{$user->firstname}}" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-label">{{$lastName}}</label>
                        <input type="text" class="form-control d-flex w-100" name="lastname" value="{{$user->lastname}}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="form-label">{{$email}}</label>
                        <input class="form-control d-flex w-100" value="{{$user->email}}" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-label">{{$phone}}</label>
                        <input class="form-control d-flex w-100" value="{{$user->mobile}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="form-label">{{$address}}</label>
                        <input type="text" class="form-control d-flex w-100" name="address" value="{{@$user->address->address}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-label">{{$state}}</label>
                        <input type="text" class="form-control d-flex w-100" name="state" value="{{@$user->address->state}}">
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-sm-4">
                        <label class="form-label">{{$zip}}</label>
                        <input type="text" class="form-control d-flex w-100" name="zip" value="{{@$user->address->zip}}">
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="form-label">{{$city}}</label>
                        <input type="text" class="form-control d-flex w-100" name="city" value="{{@$user->address->city}}">
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="form-label">{{$country}}</label>
                        <input class="form-control d-flex w-100" value="{{@$user->address->country}}" disabled>
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-dark w-100">{{$submitbtn}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection