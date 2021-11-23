@php
$setting = \App\Http\Controllers\HomeController::getSetting();
@endphp

@extends('layouts.home')

@section('title', $setting->title)

@section('description')
    {{ $setting->description }}
@endsection

@section('keywords', $setting->keywords)

@section('content')
  
    <section class="reservation-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <aside class="sidebar">
                        @include('home.user_menu')
                        
                        <!-- widget end -->
                    </aside>
                </div>
                <div class="col-lg-8">
                    @include('profile.show')
                </div>
            </div>
        </div>
    </section>

    
    <!-- consulting-section end -->
@endsection
