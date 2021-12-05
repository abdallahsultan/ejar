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
                    <h2 class="page-title">نبذه عنا</h2>
                    <ol class="page-list">
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> الرئيسية</a></li>
                        <li>/نبذه عنا</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-apge-banner end -->
    <!-- features-section start -->
    <section class="features-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-content">
                        <h2 class="title title--border">نبذه عنا</h2>
                        <p>{!!$setting->aboutus!!}</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- features-section end -->


   
    <!-- features-section start -->
    <section class="features-section pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <h2 class="section-title">بما نتميز</h2>
                        <p> ننتميز بتوفير السيارة في أي وقت يريده العميل وبايصال السيارة الى العميل وأن نكون متواجدين في جميع مناطق المملكة العربية السعودية</p>
                    </div>
                </div>
            </div>
            <div class="row mb-none-30">
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-item text-center">
                        <div class="icon"><i class="fa fa-car"></i></div>
                        <div class="content">
                            <h4 class="title">أفضل السيارات</h4>
                           
                        </div>
                    </div>
                </div><!-- icon-item end -->
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-item text-center">
                        <div class="icon"><i class="fa fa-rocket"></i></div>
                        <div class="content">
                            <h4 class="title">خدمات سريعة</h4>
                           
                        </div>
                    </div>
                </div><!-- icon-item end -->
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-item text-center">
                        <div class="icon"><i class="fa fa-volume-control-phone"></i></div>
                        <div class="content">
                            <h4 class="title">الدعم الفنى</h4>
                           
                        </div>
                    </div>
                </div><!-- icon-item end -->
            </div>
        </div>
    </section>
    <!-- features-section end -->
@endsection
