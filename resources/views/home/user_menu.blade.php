
@auth
    

<div class="widget widget-all-cars">
    <h4 class="widget-title">تحكم المستخدم</h4>
    <ul class="cars-list">
        <li><a href="{{route('myprofile')}}">الصفحة الشخصية</a></li>
        @if(Auth::user()->level == 'user')
        <li><a href="{{route('myrents')}}">حجوزاتى</a></li>
        @endif
        @if(Auth::user()->level == 'office' || Auth::user()->level == 'renter')
        <li><a href="{{route('addcar')}}">إضافه سيارة</a></li>
        <li><a href="{{route('user_car_all')}}">جميع السيارات </a></li>
        <li><a href="{{route('requestrents')}}">طلبات الحجوزات </a></li>
        @endif
        @if(Auth::user()->level == 'office' ||Auth::user()->level == 'renter' || Auth::user()->level == 'user')
        <li><a href="{{route('mymessages')}}">رسائلي</a></li>
        @endif
        <li><a href="{{route('logout')}}">تسجيل خروج</a></li>
          
        @php
             $userRoles = Auth::user()->roles->pluck('name');
        @endphp

        @if ($userRoles->contains('admin'))
        <li><a href="{{route('admin_home')}}">صفحة التحكم</a></li>
        @endif

    </ul>
</div>

@endauth