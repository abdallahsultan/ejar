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
    <section class="inner-page-banner bg_img overlay-3" data-background="{{asset('assets/images/inner-page-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">تسجيل الدخول </h2>
                    <ol class="page-list">
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> الرئيسية</a>  </li>
                        <li> /  تسجيل الدخول </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-apge-banner end -->
    @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif


    <section class="registration-section pt-120 pb-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="registration-block text-center">
            <div class="registration-block-inner">
              <h3 class="title">تسجيل الدخول</h3>
              <form class="registration-form" method="POST" action="{{ route('login') }}">
              @csrf
              
                <div class="frm-group">
                  <input class="@error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="البريد الألكترونى">
                 
                          @error('email')
                <span class="invalid-feedback" style="display: block !important;" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
                </div>
              
              
              
                <div class="frm-group">
                  <input class="@error('password') is-invalid @enderror" type="password"  name="password" id="pass" placeholder="كلمة المرور">
                </div>
                @error('password')
													<span class="invalid-feedback"  style=" display: block !important;" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
             
           
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
                <div class="frm-group">
                  <input type="submit" value="تسجيل دخول">
                </div>
             
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


    <br>
    <br>


@endsection