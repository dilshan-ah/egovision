@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mt-4 text-dark">Newsletter Subscription</h2>

                <p>Subscribe to our Newsletter, get updated about our latest products !!!</p>

                @if ($subscribed)
                    <!-- If user is already subscribed, show the unsubscribe button -->
                    <form action="{{route('user.subscribe.delete')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-uppercase" style="background: transparent; font-size: 25px; border-color: black; color: black">
                            Unsubscribe
                        </button>
                    </form>
                @else
                    <!-- If user is not subscribed, show the subscribe button -->
                    <form action="{{ route('user.subscribe.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-dark text-uppercase border"
                            style="background: black; font-size: 25px; border-color: black">
                            Subscribe
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
