@extends('layouts.ego-app')
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

    .form-label {
        text-align: left;
        font-size: 0.6875rem;
        color: rgba(0, 0, 0, 0.3);
    }
</style>
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$contactTitle = TranslationHelper::translateText('Contact Us', $preferredLanguage);
$egoVision = TranslationHelper::translateText('Ego Vision', $preferredLanguage);
$thankText = TranslationHelper::translateText('Thank you for your interest in', $preferredLanguage);
$insText = TranslationHelper::translateText('Email, call or just simply fill up the form and get connected with us. we would be happy to help you', $preferredLanguage);
$addText = TranslationHelper::translateText('98/6-A, Boro Moghbazar, Dhaka-1217, Bangladesh', $preferredLanguage);

$cusTitle = TranslationHelper::translateText('Customer Support', $preferredLanguage);
$cusText = TranslationHelper::translateText('Our support team is avaiable around the clock for any queries or concern you may have', $preferredLanguage);

$mediaTitle = TranslationHelper::translateText('Media Inquiries', $preferredLanguage);
$mediaText = TranslationHelper::translateText('For media related questions or press inquiries, please contact us at ', $preferredLanguage);

$feedTitle = TranslationHelper::translateText('Feedback', $preferredLanguage);
$feedText = TranslationHelper::translateText('We value your feedback and are continuously working to imporve Ego Vision', $preferredLanguage);

$otherTitle = TranslationHelper::translateText('Other Informations', $preferredLanguage);
$tradeLic = TranslationHelper::translateText('Trade License number:', $preferredLanguage);

$getinTouch = TranslationHelper::translateText('Get in touch', $preferredLanguage);

$nameLabel = TranslationHelper::translateText('Name', $preferredLanguage);
$emailLabel = TranslationHelper::translateText('Email', $preferredLanguage);
$subjectLabel = TranslationHelper::translateText('Subject', $preferredLanguage);
$msgLabel = TranslationHelper::translateText('Message', $preferredLanguage);

$subBtn = TranslationHelper::translateText('Submit', $preferredLanguage);
@endphp

<div class="container text-center" style="margin-top: 200px; margin-bottom: 100px">
    <div class="row">
        <div class="col-md-7 d-flex flex-column align-items-start justify-content-start pe-5">
            <h1 class="py-3">{{$contactTitle}}</h1>
            <p>{{$thankText}} <b>{{$egoVision}}</b>.</p>
            <p>{{$insText}}</p>

            <a href="mailto:customer.service@fg-bd.com" class="d-flex align-items-center gap-3 mb-2">
                <i class="fas fa-envelope"></i>
                customer.service@fg-bd.com
            </a>

            <a href="callto:+8801929990121" class="d-flex align-items-center gap-3 mb-2">
                <i class="fas fa-phone-alt"></i>
                +8801929990121
            </a>

            <span href="mailto:customer.service@fg-bd.com" class="d-flex align-items-center gap-3 mb-2">
                <i class="fas fa-map-marker-alt"></i>
                {{$addText}}
            </span>

            <div class="row py-3">
                <div class="col-md-4 text-start">
                    <h5 class="py-3">{{$cusTitle}}</h5>
                    <p>{{$cusText}}</p>
                </div>

                <div class="col-md-4 text-start">
                    <h5 class="py-3">{{$feedTitle}}</h5>
                    <p>{{$feedText}}</p>
                </div>

                <div class="col-md-4 text-start">
                    <h5 class="py-3">{{$mediaTitle}}</h5>
                    <p>{{$mediaText}}service@fg-bd.com</p>
                </div>

            </div>
            <div>
                <h3 class="py-3 text-start">{{$otherTitle}}</h3>
                <span href="mailto:customer.service@fg-bd.com" class="d-flex align-items-center gap-3 mb-2">
                    <b>{{$tradeLic}}</b>
                    TRAD/DSCC/005913/2023
                </span>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card w-100 p-4">
                <h1 class="">{{$getinTouch}}</h1>
                <div class="card-body">
                    <form action="{{route('contact.submit')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="form-label">
                                <label for="name">{{$nameLabel}}</label>
                                <input type="text" class="form-control d-flex w-100" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label for="email">{{$emailLabel}}</label>
                                <input type="email" class="form-control d-flex w-100" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label for="subject">{{$subjectLabel}}</label>
                                <input type="text" class="form-control d-flex w-100" name="subject" id="subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label">
                                <label for="message">{{$msgLabel}}</label>
                                <textarea type="text" class="form-control d-flex w-100" name="message" id="message"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">{{$subBtn}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection