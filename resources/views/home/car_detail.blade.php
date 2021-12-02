@php
$setting = \App\Http\Controllers\HomeController::getSetting();
@endphp

@extends('layouts.others')


@section('title', $data->title ?? null)

@section('description')
    {{ $data->description }}
@endsection

@section('keywords', $data->keywords)



@section('content')

    <!-- inner-apge-banner start -->
    <section class="inner-page-banner bg_img overlay-3" data-background="{{ asset('assets') }}/images/inner-page-bg.jpg" st>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">حجز السيارة</h2>
                    <ol class="page-list">
                        <li><a href="{{ route('home')}}"><i class="fa fa-home"></i> الرئيسية /</a></li>
                        <li><a href="#0">قائمة السيارات </a></li>
                        <li>حجوزات</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-apge-banner end -->
    <section class="reservation-section pt-120 pb-120">
        <div class="container">@include('home.message')
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="reservation-details-area">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="9"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="10"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @php $count=1; @endphp
                                @foreach ($dataList as $item)
                                    <div class="carousel-item {{ $count == '1' ? 'active' : '' }}">
                                        <img src="{{ Storage::url($item->image) }}" alt="" style="min-height: 400px">
                                    </div>
                                    @php $count++; @endphp
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <aside class="sidebar">
                        <div class="widget widget-all-cars">
                            <h4 class="widget-title">مواصفات السيارة</h4>
                            <ul class="cars-list">
                                <li><i style="margin-right: 10px;color: #e83231;" class="fa fa-car"></i>Model:
                                    {{ $data->model }} {{ $data->year }}
                                </li>
                                <li><i style="margin-right: 10px;color: #e83231;" class="fa fa-sliders"></i>Gear Type:
                                    {{ $data->gear_type }}
                                </li>
                                <li><i style="margin-right: 10px;color: #e83231;" class="fa fa-sliders"></i>Engine
                                    Power: {{ $data->engine_power }}hp</li>
                                <li><i style="margin-right: 10px;color: #e83231;" class="fa fa-sliders"></i>Fuel Type:
                                    {{ $data->fuel_type }}
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>

            <div class="content" style="padding-top: 50px;">
                <div class="content-block">
                    <h3 class="car-name">{{ $data->brand }} {{ $data->model }}</h3>
                    <span class="price" style="padding-top: 5px">Start form <span style="color: #e83231;font-weight:bold">
                            ريال سعودى{{ $data->price }} </span> per day</span>
                    <p>{!! $data->description !!}</p>
                </div>

                <form class="reservation-form" action="{{route('makereservation',[ 'id'=>$data->id, 'userid'=>$userid ])}}" method="POST">
                    @csrf
                    <div class="content-block" style="padding-top: 30px;">
                        <h3 class="title">بيانات الحجز</h3>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <input required type="date" name="r_start_date" class="form-control has-icon datepicker-here hasDatepicker"
                                    data-language="en" placeholder="Pickup Date" id="dp1610219160735">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <input required type="date" name="r_end_date"  class="form-control has-icon datepicker-here hasDatepicker"
                                    data-language="en" placeholder="Drop Off Date" id="dp1610219160736">
                            </div>
                            
                        </div>
                    </div>
                    <div class="content-block" style="padding-top: 30px;">
                        <div class="row">
                            
                            <div class="col-lg-6 form-group">
                                <input required type="tel"  name="phone" placeholder="الجوال ">
                            </div>
                            
                            
                        </div>
                    </div>
                   
                    <div class="content-block" style="padding-top: 30px;">
                        <h3 class="title">نوع الدفع</h3>
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <!-- <select required name="payment_method" style="display: none;">
                                    <option>طريقه الدفع</option>
                                    <option value="paypal" >Paypal</option>
                                    <option value="cash" >Payoneer</option>
                                    <option value="visacard" >Visa Card</option>
                                </select> -->
                                <div class="nice-select" tabindex="0"><span class="current">أختر طريقه الدفع</span>
                                    <ul class="list">
                                        <li data-value="Select Payment Methos" class="option selected">أختر طريقه الدفع</li>
                                        <!-- <li data-value="paypal" class="option">Paypal</li> -->
                                        <li data-value="cash" class="option">نقدى</li>
                                        <!-- <li data-value="visacard" class="option">Visa Card</li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-block" style="padding-top: 30px;">
                        <h3 class="title">تفاصيل اخرى</h3>
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <textarea name="comment" placeholder="يمكنك كتابه تفاصيل اخرى للحجز"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <button type="reset" class="cmn-btn bg-black">الغاء</button>
                                <button type="submit" class="cmn-btn">حجز </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
