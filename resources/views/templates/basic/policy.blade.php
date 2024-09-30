@extends('layouts.ego-app')
@section('content')
<style>
    h1,h3, h3 span, b font, b{
        font-family: 'Prata', serif !important;
        color: black;
    }
    p font span, p span, p, font, div{
        font-family: "Lato", sans-serif !important;
    }
</style>
<br><br><br><br><br>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="background-color: #f5f5f5; padding: 50px">
                    <div class="card-body">
                    <h1 class="card-title mb-5 text-center" style="font-family: 'Prata', serif;">{{ __($pageTitle) }}</h1>
                        @php
                            echo $policy->data_values->details
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
