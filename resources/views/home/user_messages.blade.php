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
                        <div class="widget widget-testimonial">

                        </div>
                        <!-- widget end -->
                    </aside>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title m-b-0">رسائلي</h5>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">رقم الطلب</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">البريد الألكتروني</th>
                                    <th scope="col">الجوال</th>
                                    <th scope="col">اسم الموضوع </th>
                                    <th scope="col">الرساله</th>
                                    <th scope="col">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($messages) >0)
                                @foreach ($messages as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->subject}}</td>
                                        <td>{{$item->message}}</td>
                                        @if($item->status == 'Read')
                                        <td style="color:green;">{{$item->status}}</td>
                                        @else
                                        <td style="color:red;">Not Read</td>
                                        @endif
                                    </tr>
                                @endforeach
                                @else
                                <tr style="text-align: center;font-weight: bold;"><td colspan="7"> لا يوجد رسائل</td> </tr> 
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

  

@endsection
