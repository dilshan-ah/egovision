@extends('layouts.app')
@section('content')

<style>
  .card {
    border: 0.5px solid #EEE;
    border-radius: 4px;
    padding: 30px;
    text-align: center;
    margin-bottom: 20px;
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: border 0.3s ease;
  }

  .card-title {
    font-size: 1rem;
    font-weight: bold;
    margin-top: 10px;
    color: #333;
  }

  svg {
    color: #333 !important;
  }
</style>
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$welcome = TranslationHelper::translateText('Welcome', $preferredLanguage);
$order = TranslationHelper::translateText('My Orders', $preferredLanguage);
$wishlist = TranslationHelper::translateText('Wishlist', $preferredLanguage);
$accountInfo = TranslationHelper::translateText('Account Information', $preferredLanguage);
@endphp

<h2 class="mt-4">{{$welcome}} {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h2>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <a href="{{route('ego.orders')}}">
        <i class="fas fa-box"></i>
        <h3 class="card-title">{{$order}}</h3>
      </a>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <a href="{{route('ego.wishlist')}}">
        <i class="fas fa-heart"></i>
        <h3 class="card-title">{{$wishlist}}</h3>
      </a>
    </div>
  </div>
  <!-- <div class="col-md-4">
    <div class="card">
      <a href="#">
        <i class="fas fa-address-book"></i>
        <h3 class="card-title">Address Book</h3>
      </a>
    </div>
  </div> -->
  <div class="col-md-4">
    <div class="card">
      <a href="{{ route('user.profile.setting') }}">
        <i class="fas fa-user"></i>
        <h3 class="card-title">{{$accountInfo}}</h3>
      </a>
    </div>
  </div>
  <!-- <div class="col-md-4">
          <div class="card">
            <a href="#">
              <i class="fas fa-credit-card"></i>
              <h3 class="card-title">Payment Methods</h3>
            </a>
          </div>
        </div> -->
  <!-- <div class="col-md-4">
    <div class="card">
      <a href="#">
        <i class="fas fa-sliders-h"></i>
        <h3 class="card-title">Compare Products</h3>
      </a>
    </div>
  </div> -->
</div>
@endsection