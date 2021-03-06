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
    <section class="inner-page-banner bg_img overlay-3" data-background="{{ asset('assets') }}/images/inner-page-bg.jpg" st>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">جميع السيارات</h2>
                    <ol class="page-list">
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> الرئيسية</a></li>
                        <li><a href="#0">جميع السيارات </a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="car-search-filter-area">
                        <div class="car-search-filter-form-area">
                            <form class="car-search-filter-form" action="{{ route('getcar') }}" method="POST">
                                @csrf
                                <div class="row justify-content-between">
                                    <div class="col-lg-12 col-md-7 col-sm-4 d-flex">
                                        @livewire('search')

                                        <button class="search-submit-btn">بحث</button>
                                    </div>
                                </div>
                            </form>
                            @livewireScripts
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-apge-banner end -->

    <!-- car-search-section start -->
    <section class="car-search-section pt-120 pb-120">
        <div class="container">

            <div class="view-style-toggle-area">
                <button class="view-btn list-btn"><i style="color: #e83231;" class="fa fa-bars"></i></button>
                <button class="view-btn grid-btn active"><i style="color: #e83231;" class="fa fa-th-large"></i></button>
            </div>
            <div class="row mt-70">

                <div class="col-lg-12">
                    <div class="car-search-result-area grid--view row mb-none-30">

                        @foreach ($dataList as $item)


                            <div class="col-md-4 col-12">
                                <div class="car-item">

                                <img src="{{ Storage::url($item->image) }}" alt="image" style="height: 270px; width:100%;">
                                    <div class="car-item-body">
                                        <div class="content">
                                            <h4 class="title">{{ $item->brand }} {{ $item->model }}</h4>
                                            <span class="price">تبدأ من  ريال سعودى{{ $item->price }} ريال في اليوم</span>y
                                            <hr>
                                            <span class="name">الأسم:  {{ $item->user->name }}</span>
                                            &nbsp;	
                                            <span class="phone"> الجوال :{{ $item->user->phone }}</span>
                                            <hr>
                                            <p>{!! $item->description !!}</p>
                                            <a href="{{ route('cardetail', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                                class="cmn-btn">rent car</a>
                                        </div>
                                        <div class="car-item-meta">
                                            <ul class="details-list">
                                                <li><i class="fa fa-car"></i>{{ $item->model }} {{ $item->year }}</li>
                                                <li><i class="fa fa-sliders"></i>{{ $item->gear_type }}</li>
                                                <li><i class="fa fa-sliders"></i>{{ $item->engine_power }}hp</li>
                                                <li><i class="fa fa-sliders"></i>{{ $item->fuel_type }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- car-item end -->
                        @endforeach
                    </div>
                    <nav class="d-pagination" aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                        @if ($dataList->links()->paginator->hasPages())
                                <div style="color:red;" class="mt-4 p-4 box has-text-centered">
                                    {{ $dataList->links() }} 
                                </div>
                            @endif
                           
                        </ul>
                    </nav>
                </div>




            </div>
        </div>
        </div>
    </section>
    <!-- car-search-section end -->
@endsection
