<!-- banner-section start  -->
<section class="banner-section bg_img" data-background="{{asset('assets/images/banner.jpg')}}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12" style="
            margin-top: 75px;
            margin-bottom: 0px;">
                <div class="banner-content">
                    <h1 class="title" >إيجار</h1>
                        <p>إيجار له جانبان خدمي حيث يوفر للعميل أي سيارة
                        في أي وقت وفي أي مكان وتصل السيارة إلى موقعه
                        ولكن في نفس الوقت المشروع له جانب ربحي لضمان
                        تغطية تكاليف المشروع واستمراريته بجودة عالية وأيضا
                    مصدر دخل إضافي لأصحاب المشروع
                        </p>
                    <a  href="{{route('all_cars')}}" class="cmn-btn">عرض قائمة السيارات</a>
                </div>
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
<!-- banner-section end  -->
