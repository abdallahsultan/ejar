
@php
    $setting = \App\Http\Controllers\HomeController::getSetting();
@endphp
<!-- footer-section start -->
<footer class="footer-section">
    <div class="footer-top pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-8">
                    <div class="footer-widget widget-about">
                        <div class="widget-about-content">
                            <a href="index.html" class="footer-logo"><img style="    border: 1px solid red;border-radius: 100%;" src="{{asset('assets')}}/images/logo-footer.png"
                                    alt="logo"></a>
                            <p>ايجار ذو فرص واعدة ويستحق المجازفة نظر ا للطب الكبير في السوق، وللدعم
الحكومي مع قلة المنافسين في هذا المجال (خصوص  أنه  يتميز عن المنافسين
بإيصال السيارة للعميل في أي يوم وفي أي وقت أما السيارات التجارية في أي يوم وأي
وقت أثناء أوقات عمل الشركة المُعلنة في اعلان الشركة نظر ا لاعتماده على الموقع والتطبيق)، بالإضافة إلى النمو السكاني، وتحسن
الوضع الاقتصادي، والقوة الشرائية الكبيرة.
                            </p>
                            <ul class="social-links">
                                <li><a href="{{$setting->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{$setting->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{$setting->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="{{$setting->youtube}}" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="https://play.google.com/store/apps/details?id=alphagroup.eyjar.com" target="_blank"><i class="fa fa-android" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <div class="footer-widget widget-menu">

                    </div>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <div class="footer-widget widget-menu">
                        <h4 class="widget-title">روابط مفيدة</h4>
                        <ul>
                            <li><a href="{{ route('aboutus') }}" target="_blank">نبذه عنا</a></li>
                            <li><a href="{{route('all_cars')}}"  target="_blank">قائمةالسيارات</a></li>
                            <li><a href="{{ route('faq') }}"  target="_blank">اسئلة مكررة</a></li>
                            <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSdpkut-chCSSEVYKc7KLuiLBUpU_yX5vNzf-12XEQRiK4MRpg/viewform" target="_blank">استبيان قياس رضا العملاء</a></li>
                            
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-10">
                    <div class="footer-widget widget-address">
                        <h4 class="widget-title">تواصل معنا عن :</h4>
                        <ul>
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <span>{{$setting->address}}</span>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <span>{{$setting->email}}</span>
                            </li>
                            <li>
                                <i class="fa fa-phone-square"></i>
                                <span>{{$setting->phone}} </span>
                            </li>
                            <li>
                                <i class="fa fa-fax"></i>
                                <span>  {{$setting->fax}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6">
                    <p class="copy-right-text"><a href="{{route('home')}}">{{ $setting->company }}</a></p>
                </div>
                <div class="col-sm-6">
                    <ul class="payment-method d-flex justify-content-end">
                        <li><a href="{{route('admin_login')}}"> تسجيل دخول أدمن </a> | </li>
                        <li> | <a href="{{route('admin_login')}}"> تسجيل خروج الأدمن </a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-section end -->


<!-- scroll-to-top start -->
<div class="scroll-to-top">
    <span class="scroll-icon">
        <i class="fa fa-rocket"></i>
    </span>
</div>
<!-- scroll-to-top end -->


</body>

</html>
