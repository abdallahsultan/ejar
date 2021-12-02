@php
$setting = \App\Http\Controllers\HomeController::getSetting();

@endphp
<!-- اهم حته -->
@extends('layouts.home')

@section('title', $setting->title)

@section('description')
    {{ $setting->description }}
@endsection

@section('keywords', $setting->keywords)


@section('content')
    <!-- search-section start -->
    <section class="search-section" style="padding-top: 30px; margin-bottom:40px; margin-left:250px;margin-right:auto">
        <div class="container justify-content-center">
            <!-- @include('home._slider') -->
        </div>
    </section>



    <!-- search-section end -->
    <!-- choose-car-section start -->

    <section class="choose-car-section pb-120 section-bg">
        <div class="container">
            {{-- @include('home._slider') --}}
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <h2 class="section-title" style="color: #e83231">أحدث الإضافات</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="choose-car-slider owl-carousel" dir="ltr">

                        @foreach ($last as $item)
                            <div class="car-item" >
                                <div class="thumb">
                                    <img src="{{ Storage::url($item->image) }}" alt="image" style="height: 270px; width:100%;">
                                </div>
                                <div class="car-item-body">
                                    <div class="content">
                                        <h4 class="title">{{ $item->model }} {{ $item->brand }}</h4>
                                        <span class="price">start form <span style="color: #e83231;font-weight:bold">
                                                ريال سعودى{{ $item->price }} </span> per day</span>
                                                <hr>
                                            <span class="name">الأسم:  {{ $item->user->name }}</span>
                                            <br>	
                                            <span class="phone"> الجوال :{{ $item->user->phone }}</span>
                                            <hr>
                                        <!-- <p>Aliquam sollicitudin dolores tristiquvel ornare, vitae aenean.</p> -->
                                        <a href="{{ route('cardetail', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                            class="cmn-btn">حجز السيارة</a>
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
                            <!-- car-item end -->
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </section>
    <!-- choose-car-section end -->

   

    <!-- features-section start -->
    <section class="features-section pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <h2 class="section-title">بما نتميز</h2>
                        <p> نستهدف في إيجار كبداية أكبر الشركات العاملة في مجال تأجير
السيارات نظر ا لسمعتها، ولحجمها، ولانتشار فروعها</p>
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

    <!-- rent-step-section start -->
    <section class="rent-step-section pb-120">
        <div class="element-one"><img src="assets/images/elements/car.png" alt="image"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="block-area">
                        <div class="block-header">
                            <h2 class="title">مرحبا بكم فى إيجار </h2>
                            <p>تطبيق وموقع الكتروني يكون وسيط بين الشركات والعملاء بحيث أنها تتيح فرصة
التأجير 24 ساعة وتسلم السيارة للعميل عن طريق الشركة أو صاحب السيارة
الشخصية حيث أن الشركات والأشخاص الراغبين في تأجير سيارتهم يسجلون في
الموقع ويضعون السيارات ومواصفاتها وصورها وأسعار تأجيرها مما يساعدهم في
تقليص عدد الموظفين والرسوم والفواتير... ويوفر التكاليف الاجمالية وأيض ا تعتبر
توفير للجهد والوقت والمال للعميل بتوصيل السيارة إلى موقعه...
ويكون هنالك عقد الكتروني وبعد الاتفاق بين الطرفين على العقد يخير العميل بين أن
تقوم الشركة بتوصيل السيارة له أو يقوم العميل بالذهاب للموقع واستلامها.</p>
                        </div>
                        <!-- <div class="block-body">
                            <ul class="num-list">
                                <li><span class="num">01</span>Download Car rent app</li>
                                <li><span class="num">02</span>choose the car you like</li>
                                <li><span class="num">03</span>car reservation</li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- rent-step-section end -->



    

 

   

  


    <!-- consulting-section start -->
    <section class="consulting-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row mb-none-30">
                        <div class="col-sm-6">
                            <div class="brand-item">
                                <div class="brand-item--inner">
                                    <img src="assets/images/brand-logo/1.png" alt="image">
                                </div>
                            </div>
                        </div><!-- brand-item end -->
                        <div class="col-sm-6">
                            <div class="brand-item">
                                <div class="brand-item--inner">
                                    <img src="assets/images/brand-logo/2.png" alt="image">
                                </div>
                            </div>
                        </div><!-- brand-item end -->
                        <div class="col-sm-6">
                            <div class="brand-item">
                                <div class="brand-item--inner">
                                    <img src="assets/images/brand-logo/3.png" alt="image">
                                </div>
                            </div>
                        </div><!-- brand-item end -->
                        <div class="col-sm-6">
                            <div class="brand-item">
                                <div class="brand-item--inner">
                                    <img src="assets/images/brand-logo/4.png" alt="image">
                                </div>
                            </div>
                        </div><!-- brand-item end -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="consulting-from-area">
                        <h2 class="title">تواصل معنا</h2>
                        @include('home.message')
                        <form class="consulting-form" method="POST" action="{{ route('sendmessage') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="text" name="name" id="name" placeholder="الاسم ">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" id="email" placeholder="البريد الأليكترونى">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="tel" name="phone" id="phone" placeholder="الجوال">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 ">
                                    <input type="text" name="subject" id="subject" placeholder="الموضوع">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="الرساله"></textarea>
                            </div>
                            <button type="submit" class="cmn-btn">ارسل الان</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- consulting-section end -->
@endsection
