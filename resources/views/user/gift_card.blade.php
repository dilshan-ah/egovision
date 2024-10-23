@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mt-4 text-dark">Gift Card</h2>

            <p>Check balance and status of gift cards to apply while ordering</p>

            <form action="{{ route('user.ego.search.giftCard') }}" method="GET" class="mb-5">
                <input type="text" style="width: 100%" name="code" placeholder="Type gift code here"
                    class="form-control py-5 px-3" value="{{ request('code') }}">
                <button type="submit" class="btn text-uppercase text-white"
                    style="background: black; font-size: 25px; border-color: black; color: black">
                    Check
                </button>
            </form>

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if (isset($giftCard))
            <div class="gift-card-details">
                <h2>Gift Card Code: {{ $giftCard->code }}</h2>
                <p>Balance: {{ $giftCard->balance }}BDT</p>
                <p>Initial Balance: {{ $giftCard->initial_balance }}BDT</p>
                <p>Expiry Date: {{ $giftCard->expiry_date->diffForHumans() }}</p>
                <p>Cutoff Percentage: {{ $giftCard->cutoff_percentage }}%</p>
            </div>
            @endif



        </div>
    </div>
</div>
@endsection