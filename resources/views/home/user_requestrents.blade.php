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
                <div class="col-lg-3">
                    <aside class="sidebar">
                    @include('home.user_menu')
                        <div class="widget widget-testimonial">

                        </div>
                        <!-- widget end -->
                    </aside>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title m-b-0">طلبات الحجوزات</h5>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نوع الدفع</th>
                                    <th scope="col">الأسم</th>
                                    <th scope="col">الجوال</th>
                                    <th scope="col">السعر  لكل الأيام</th>
                                    <th scope="col">من</th>
                                    <th scope="col">الى</th>
                                    <th scope="col">ضبط</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($res as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->payment_method}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->r_end_date}}</td>
                                        <td>{{$item->r_start_date}}</td>
                                        <td><a
                                            class="btn btn-outline-info w-100 "
                                            style="text-decoration: none;color:black;border-radius:7px"
                                            href="{{ route('Acardetail', ['id' => $item->car_id]) }}"
                                            target="_blank">تفاصيل السيارة</a></td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

  

@endsection
