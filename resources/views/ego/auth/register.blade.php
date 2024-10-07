@extends('layouts.ego-app')
@section('content')
@php
    $policyPages = getContent('policy_pages.element',false,null,true);
@endphp
    <style>
        .container {
            margin-top: 5%;
        }

        .bg-register {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            text-align: center;
            color: #000;
        }

        .form-section h2 {
            margin-bottom: 1.5rem;
            font-weight: bold;
            color: #000;
        }

        .form-section p,
        .form-section label {
            margin-bottom: 1rem;
            color: #333;
            text-align: left;
        }

        .form-section .form-check-label,
        .form-section .form-label {
            color: #333;
        }

        .form-section .btn-primary {
            background-color: #000;
            border-color: #000;
            color: #fff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .form-section .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }

        .form-section a {
            color: #000;
            transition: color 0.3s ease;
        }

        .form-section a:hover {
            color: #333;
        }

        .forgot-password-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left;
        }

        .forgot-password-container p {
            background-color: #eaeaea;
            font-size: 14px;
            padding: 10px;
            border-radius: 5px;
            flex: 1;
        }

        .forgot-password-container a {
            font-size: 14px;
            color: #000;
            text-decoration: none;
            border-bottom: 1px dashed #000;
            padding-bottom: 2px;
            margin-left: 15px;
            flex-shrink: 0;
        }

        .form-check {
            text-align: left;
        }

        .btn-google {
            color: #545454;
            background-color: #ffffff;
            box-shadow: 0 1px 2px 1px #ddd;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                margin-top: 10%;
            }
            .form-section {
                padding: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .form-section {
                padding: 1rem;
            }
            .form-section h2 {
                font-size: 1.5rem;
            }
            .form-section p {
                font-size: 0.9rem;
            }
            .form-section input, .form-section button {
                font-size: 0.9rem;
            }
        }
    </style>
    </head>

    <body>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <!-- Register Section -->
                <div class="col-md-5 form-section">
                    <div class="p-5 bg-register">
                        <h2>Register</h2>
                        <p><b>ALREADY CLIENT? <a href="{{ route('ego.login') }}" class="text-primary">LOGIN</a></b></p>
                        <form action="{{ route('user.ego.register.post') }}" method="post">
                            @csrf
                            <div class="mb-3 text-start">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstName"
                                    placeholder="Enter your first name">
                            </div>
                            <div class="mb-3 text-start">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastName"
                                    placeholder="Enter your last name">
                            </div>
                            <div class="form-check text-start mb-3">
                                <input type="checkbox" class="form-check-input" id="newsletter">
                                <label class="form-check-label" for="newsletter">Sign Up for Newsletter</label>
                            </div>
                            <p class="text-start">By signing up for our newsletter, we will keep you informed by email on
                                all the latest news and promotions. You will also receive a 10% off coupon to apply to your
                                first order.</p>
                            <div class="mb-3 text-start">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" id="dob">
                            </div>
                            <div class="mb-3 text-start">
                                <label for="telephone" class="form-label">Telephone</label>
                                <input type="tel" class="form-control" name="mobile" id="telephone" placeholder="+008">
                            </div>
                            <div class="mb-3 text-start">
                                <label for="location" class="form-label">Location</label>
                                <select name="location" class="form-control" id="location">
                                    @foreach($states['states'] as $state)
                                    <option value="{{$state['name']}}">{{$state['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 text-start">
                                <label for="registerEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="registerEmail"
                                    placeholder="Enter your email">
                            </div>
                            <div class="mb-3 text-start">
                                <label for="registerPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="registerPassword"
                                    placeholder="Enter your password">
                            </div>
                            <p class="text-start">Password Strength: <span id="passwordStrength">No Password</span></p>
                            <div class="mb-3 text-start">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="confirmPassword" placeholder="Confirm your password">
                            </div>
                            <div class="form-check text-start mb-3">
                                <input type="checkbox" class="form-check-input" id="privacyPolicy">
                                <label class="form-check-label" for="privacyPolicy">I have read and accept <span>@foreach($policyPages as $policy) <a href="{{ route('policy.pages',[$policy->id, slug($policy->data_values->title)]) }}">{{ __($policy->data_values->title) }}</a> @if(!$loop->last), @endif @endforeach</span></label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mt-5">CREATE AN ACCOUNT</button>
                        </form>

                        <div class="row my-5">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-auto">OR</div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="telephone" class="form-label">Telephone</label>
                            <input type="tel" class="form-control" name="mobile" id="telephone" placeholder="+008">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="registerEmail"
                                placeholder="Enter your email">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="registerPassword"
                                placeholder="Enter your password">
                        </div>
                        <p class="text-start">Password Strength: <span id="passwordStrength">No Password</span></p>
                        <div class="mb-3 text-start">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="confirmPassword" placeholder="Confirm your password">
                        </div>
                        <div class="form-check text-start mb-3">
                            <input type="checkbox" class="form-check-input" id="privacyPolicy">
                            <label class="form-check-label" for="privacyPolicy">I have read and accept 
                                @foreach($policyPages as $policy) 
                                    <a href="{{ route('policy.pages',[$policy->id, slug($policy->data_values->title)]) }}">{{ __($policy->data_values->title) }}</a> 
                                    @if(!$loop->last), @endif 
                                @endforeach
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-5">CREATE AN ACCOUNT</button>
                    </form>
                        <div class="row my-5">
                            <div class="col-md-12">
                                <a href="{{route('google.auth')}}" class="btn btn-lg btn-google btn-block text-uppercase btn-outline text-black w-100" style="font-size: 16px">
                                    <img src="https://img.icons8.com/color/16/000000/google-logo.png"> Signup Using Google
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">OR</div>
                        <div class="col">
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('google.auth')}}" class="btn btn-lg btn-google btn-block  btn-outline text-black" style="font-size: 16px">
                                <img src="https://img.icons8.com/color/16/000000/google-logo.png"> Signup Using Google
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
