@extends('layouts.ego-app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/brands.min.css" integrity="sha512-EJp8vMVhYl7tBFE2rgNGb//drnr1+6XKMvTyamMS34YwOEFohhWkGq13tPWnK0FbjSS6D8YoA3n3bZmb3KiUYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .container {
        margin-top: 5%;
    }

    .form-section {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(132, 98, 170, 1);
        margin-bottom: 2rem;
        text-align: center;
    }

    .form-section h2 {
        margin-bottom: 1.5rem;
        font-weight: bold;
        color: rgba(45, 91, 169, 1);
    }

    .form-section p {
        margin-bottom: 1rem;
        color: #333;
        text-align: left;
    }

    .form-section ul {
        text-align: left;
    }

    .form-section .form-check-label,
    .form-section .form-label {
        color: #333;
    }

    .form-section .btn-primary {
        background-color: rgba(45, 91, 169, 0.8);
        border-color: rgba(45, 91, 169, 0.8);
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .form-section .btn-primary:hover {
        background-color: rgba(45, 91, 169, 1);
        border-color: rgba(45, 91, 169, 1);
    }

    .form-section a {
        color: rgba(45, 91, 169, 0.8);
        transition: color 0.3s ease;
    }

    .form-section a:hover {
        color: rgba(45, 91, 169, 1);
    }

    .forgot-password-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: left;
    }

    .forgot-password-container p {
        background-color: #fcdbdb;
        font-size: 14px;
        padding: 10px;
        border-radius: 5px;
        flex: 1;
    }

    .forgot-password-container a {
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        border-bottom: 1px dashed #007bff;
        padding-bottom: 2px;
        margin-left: 15px;
        flex-shrink: 0;
    }

    .form-check {
        text-align: left;
    }

    @media (max-width: 767px) {
        .col-6 {
            width: 100%;
            padding: 0 15px;
        }

        .forgot-password-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .forgot-password-container p {
            margin-bottom: 1rem;
        }

        .forgot-password-container a {
            margin-left: 0;
        }

        .form-section {
            padding: 1.5rem;
        }

        .form-section h2 {
            font-size: 1.5rem;
        }

        .form-section p {
            font-size: 0.9rem;
        }

        .form-section ul {
            font-size: 0.9rem;
        }

        .btn {
            font-size: 14px;
        }
    }
</style>
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$loginTitle = TranslationHelper::translateText('Login', $preferredLanguage);
$haveAccount = TranslationHelper::translateText('If you have an account, sign in with your email address.', $preferredLanguage);
$emailLabel = TranslationHelper::translateText('Email/User Name', $preferredLanguage);
$passwordLabel = TranslationHelper::translateText('Password', $preferredLanguage);
$rememberLabel = TranslationHelper::translateText('Remember Me', $preferredLanguage);
$resetPassword = TranslationHelper::translateText('If you have not reset your password in 2023, your password has expired and must be changed by clicking the link below. ', $preferredLanguage);
$forgotPassword = TranslationHelper::translateText('Forgot your password?', $preferredLanguage);
$signGoogle = TranslationHelper::translateText('Sign in Using Google', $preferredLanguage);
$signFacebook = TranslationHelper::translateText('Sign in Using Facebook', $preferredLanguage);

$newCustomer = TranslationHelper::translateText('New Customers', $preferredLanguage);
$checkFast = TranslationHelper::translateText('Check out faster, keep more than one address, track orders, and more.', $preferredLanguage);
$accCreate = TranslationHelper::translateText('Creating an account has many benefits:', $preferredLanguage);

$regOne = TranslationHelper::translateText('Get 10% off your first order by signing up for our newsletter.', $preferredLanguage);
$regTwo = TranslationHelper::translateText('Receive email delivery updates.', $preferredLanguage);
$regThree = TranslationHelper::translateText('Easy access to your order history.', $preferredLanguage);

$regBtn = TranslationHelper::translateText('Register', $preferredLanguage);
@endphp
<body>
    <br><br><br><br><br><br><br>
    <div class="container">
        <div class="row">
            <!-- Left section -->
            <div class="col-md-6 col-12" style="background-color: black">
                <div class="row">
                    <div class="col-12 mt-5 mb-5">
                        <div class="p-5 bg-light">
                            <h2>{{$loginTitle}}</h2>
                            <p><b>{{$haveAccount}}</b></p>
                            <form action="{{route('user.login')}}" method="post">
                                @csrf
                                <div class="mb-3 text-start">
                                    <label for="loginEmail" class="form-label">{{$emailLabel}}</label>
                                    <input type="email" class="form-control" name="username" id="loginEmail" placeholder="Enter your email">
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="loginPassword" class="form-label">{{$passwordLabel}}</label>
                                    <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Enter your password">
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                    <label class="form-check-label" for="rememberMe">{{$rememberLabel}}</label>
                                </div>
                                <div class="forgot-password-container mb-3 text-center">
                                    <p style="font-size: 1rem; color: #333; line-height: 1.5;">
                                        {{$resetPassword}}
                                        <span style="font-weight: 600;">
                                            <a href="{{ route('user.password.request') }}" style="color: #E9814C; text-decoration: none; border-bottom: 2px solid #E9814C; transition: color 0.3s ease;">
                                                {{$forgotPassword}}
                                            </a>
                                        </span>
                                    </p>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">{{$loginTitle}} <span><i class="fas fa-arrow-right mx-3" style="color: white; font-size:12px;"></i></span></button>
                            </form>
                            <div class="w-100 d-flex justify-content-center mt-3">
                                <a href="{{route('google.auth')}}" class="btn btn-lg btn-google btn-block btn-outline text-black shadow" style="font-size: 16px">
                                    <img src="https://img.icons8.com/color/16/000000/google-logo.png"> {{$signGoogle}}
                                </a>
                            </div>

                            <div class="w-100 d-flex justify-content-center mt-3">
                                <a href="{{route('facebook.auth')}}" class="btn btn-lg btn-google btn-block btn-outline text-black shadow" style="font-size: 16px">
                                    <img width="16px" src="https://img.icons8.com/?size=100&id=118497&format=png&color=000000"> {{$signFacebook}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right section -->
            <div class="col-md-6 col-12" style="background-color: #E6E6E6">
                <div class="row">
                    <div class="col-12 mt-5 mb-5">
                        <div class="p-5 bg-light">
                            <h2>{{$newCustomer}}</h2>
                            <p>{{$checkFast}}</p>
                            <p><b>{{$accCreate}}</b></p>
                            <ul>
                                <li>{{$regOne}}</li>
                                <li>{{$regTwo}}</li>
                                <li>{{$regThree}}</li>
                            </ul>
                            <a href="{{route('ego.register')}}" class="btn btn-dark w-100 mt-5 text-light">{{$regBtn}} <span><i class="fas fa-arrow-right mx-3" style="color: white; font-size:12px;"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection