@extends('layouts.app')
@section('content')
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$newsLetter = TranslationHelper::translateText('Newsletter Subscription', $preferredLanguage);
$subscribedTxt = TranslationHelper::translateText('Subscribe to our Newsletter, get updated about our latest products !!!', $preferredLanguage);
$subscribe = TranslationHelper::translateText('Subscribe', $preferredLanguage);
$unsubscribe = TranslationHelper::translateText('Unsubscribe', $preferredLanguage);
@endphp
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mt-4 text-dark">{{$newsLetter}}</h2>

                <p>{{$subscribe}}</p>

                @if ($subscribedTxt)
                    <!-- If user is already subscribed, show the unsubscribe button -->
                    <form action="{{route('user.subscribe.delete')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-uppercase" style="background: transparent; font-size: 25px; border-color: black; color: black">
                            {{$unsubscribe}}
                        </button>
                    </form>
                @else
                    <!-- If user is not subscribed, show the subscribe button -->
                    <form action="{{ route('user.subscribe.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-dark text-uppercase border"
                            style="background: black; font-size: 25px; border-color: black">
                           {{$subscribe}}
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
