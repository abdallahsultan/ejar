@php
$setting = \App\Http\Controllers\HomeController::getSetting();
@endphp

@extends('layouts.others')


@section('title', $setting->title)

@section('description')
    {{ $setting->description }}
@endsection

@section('keywords', $setting->keywords)


@section('content')
    <!-- inner-apge-banner start -->
    <section class="inner-page-banner bg_img overlay-3" data-background="assets/images/inner-page-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">تواصل معنا</h2>
                    <ol class="page-list">
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> الرئيسية</a>  </li>
                        <li> / تواصل معانا </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-apge-banner end -->


    <!-- consulting-section start -->
    <section class="consulting-section pt-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="consulting-from-area">
                        <h2 class="title">تواصل معنا</h2>
                        @include('home.message')
                        <form class="consulting-form" method="POST" action="{{route('sendmessage')}}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="text" name="name" id="name" placeholder="ألاسم أو اللقب">
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" id="email" placeholder="البريد الإلكترونى">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="tel" name="phone" id="phone" placeholder="الجوال ">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 ">
                                    <input type="text" name="subject" id="subject" placeholder="الموضوع">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="رسالة"></textarea>
                            </div>
                            <button type="submit" class="cmn-btn">أرسل الان</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- consulting-section end -->

    <br>
    <br>


@endsection