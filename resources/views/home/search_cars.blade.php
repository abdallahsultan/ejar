@php
$setting = \App\Http\Controllers\HomeController::getSetting();
@endphp

@extends('layouts.others')


@section('title', $search . ' Cars List')

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
                    <h2 class="page-title">بحث</h2>
                    <ol class="page-list">
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> الرئيسية</a></li>
                        <li><a href="#0">{{ $search }} أبحث عن سيارة</a></li>
                    </ol>
                </div>
            </div>
           
        </div>
    </section>
    <!-- inner-apge-banner end -->

    <!-- car-search-section start -->
    <section class="car-search-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="car-search-filter-area">
                        <div class="car-search-filter-form-area">
                            <form class="car-search-filter-form" action="{{ url('carsearch') }}" method="GET">
                                <div class="row justify-content-between">
                                    <div class="col-lg-4 col-md-5 col-sm-6">
                                        <div class="cart-sort-field">
                                            <span class="caption">ترتيب ب : </span>
                                            <select name="orderby" >
                                               
                                                <option value="low_price">أقل سعر</option>
                                                <option value="higher_price">أعلى سعر</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-6 d-flex">
                                        <input type="text" name="car_search" id="car_search"
                                            placeholder="بحث عن ماتريد">
                                        <button class="search-submit-btn">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="view-style-toggle-area">
                            <button class="view-btn list-btn"><i class="fa fa-bars"></i></button>
                            <button class="view-btn grid-btn active"><i class="fa fa-th-large"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-70">
                <div class="col-lg-12">
                    <div id="searchcar" class="car-search-result-area grid--view row mb-none-30">
                        @if(count($dataList) > 0)
                        @foreach ($dataList as $item)


                            <div class="col-md-4 col-12">
                                <div class="car-item">

                                    <img src="{{ Storage::url($item->image) }}" alt="image" style="height: 270px;">
                                    <div class="car-item-body">
                                        <div class="content">
                                            <h4 class="title">{{ $item->brand }} {{ $item->model }}</h4>
                                            <span class="price">start form ريال سعودى{{ $item->price }} per day</span>
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
                        @else 
                        <div style="    text-align: center;" class="col-md-12 col-12">
                               
                                    <h2>لا يوجد سياره بهذه الموصفات</h2>
                               
                            </div>
                        @endif 
                    </div>
                  
                </div>
                <!-- <div class="col-lg-4">
                    <aside class="sidebar">
                        <div class="widget widget-reservation">
                            <h4 class="widget-title">reservation</h4>
                            <div class="widget-body">
                                <form class="car-search-form">
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <select>
                                                <option value="1" selected>Choose Your Car Type</option>
                                                <option value="2">Another option</option>
                                                <option value="4">Potato</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <i class="fa fa-map-marker"></i>
                                            <input class="form-control has-icon" type="text" placeholder="Pickup Location">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <i class="fa fa-map-marker"></i>
                                            <input class="form-control has-icon" type="text"
                                                placeholder="Drop Off Location">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <i class="fa fa-calendar"></i>
                                            <input type='text' class='form-control has-icon datepicker-here'
                                                data-language='en' placeholder="Pickup Date">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <i class="fa fa-clock-o"></i>
                                            <input type="text" name="timepicker" class="form-control has-icon timepicker"
                                                placeholder="Pickup Time">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <i class="fa fa-calendar"></i>
                                            <input type='text' class='form-control has-icon datepicker-here'
                                                data-language='en' placeholder="Drop Off Date">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <i class="fa fa-clock-o"></i>
                                            <input type="text" name="timepicker" class="form-control has-icon timepicker"
                                                placeholder="Drop Off Time">
                                        </div>
                                    </div>
                                    <button type="submit" class="cmn-btn">Reservation</button>
                                </form>
                            </div>
                        </div> 
                      
                        <div class="widget widget-price-filter">
                            <h4 class="widget-title">price filter</h4>
                            <div class="widget-body">
                                <div id="slider-range"></div>
                                <div class="filter-price-result">
                                    <input type="text" id="amount" readonly><span>(Per Day)</span>
                                </div>
                            </div>
                        </div> -->
                        
                    </aside>
                </div> 
            </div>
        </div>
    </section>
    <!-- car-search-section end -->
@endsection
