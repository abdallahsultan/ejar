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
                        <div class="table-responsive">
                            <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="zero_config"
                                            class="table table-sm table-striped table-bordered dataTable" role="grid"
                                            aria-describedby="zero_config_info">
                                            <thead>
                                                <tr role="row">
                                                    
                                                   
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1"
                                                        colspan="1" aria-label="Name: activate to sort column ascending"
                                                        style="width: 54px;">Type</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1"
                                                        colspan="1" aria-label="Name: activate to sort column ascending"
                                                        style="width: 54px;">Brand</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1"
                                                        colspan="1" aria-label="Name: activate to sort column ascending"
                                                        style="width: 45px;">Model</th>


                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1"
                                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                                        style="width: 69px;">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1"
                                                        colspan="1" aria-label="Office: activate to sort column ascending"
                                                        style="width: 50px;">Image</th>
                                                    <th class="sorting w-25" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="4"
                                                        aria-label="Start date: activate to sort column ascending"
                                                        style="width: 57px;color:black;text-align:center">Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($dataList as $item)
                                                    <tr role="row" class="odd">
                                                        <!-- <td style="line-height: 40px;" class="sorting_1"> {{ $item->id }}
                                                        </td> -->
                                                        <!-- <td style="line-height: 40px;" class="sorting_1">
                                                            <a href="{{ route('admin_user_show', ['id' => $item->user_id]) }}"
                                                                onclick="return !window.open(this.href,'','top=50,left=100,width=800,height=600')">
                                                                {{ $item->user->name }}
                                                            </a>
                                                        </td> -->

                                                        <td style="line-height: 40px;width: 180px;" class="sorting_1">
                                                            {{ \App\Http\Controllers\Admin\CategoryController::getParentsTree($item->category, $item->category->title) }}
                                                        </td>
                                                        <td style="line-height: 40px"> {{ $item->brand }} </td>
                                                        <td style="line-height: 40px"> {{ $item->model }} </td>

                                                        <td style="line-height: 40px"> {{ $item->status }} </td>
                                                        <td style="line-height: 40px;text-align: center;">
                                                            @if ($item->image)
                                                                <img src="{{ Storage::url($item->image) }}"
                                                                    style="width: 30px;height: 30px;">
                                                            @endif
                                                        </td>
                                                        <td style="line-height: 40px"><a
                                                                class="btn btn-outline-success w-100 "
                                                                style="text-decoration: none;color:black;border-radius:7px"
                                                                href="{{ route('user_car_detail', ['id' => $item->id]) }}"
                                                                onclick="return !window.open(this.href,'','top=50,left=100,width=800,height=600')">Car
                                                                Detail</a>
                                                        </td>
                                                        <td style="line-height: 40px">
                                                            <a class="btn btn-outline-info w-100"
                                                                style="text-decoration: none;color:black;border-radius:7px"
                                                                href="{{ route('User_image_addcar', ['car_id' => $item->id]) }}"
                                                                onclick="return !window.open(this.href,'','width=700px height=700px')">
                                                                Add Image</a>
                                                        </td>

                                                        <td style="line-height: 40px"><a
                                                                class="btn btn-outline-warning w-100 "
                                                                style="text-decoration: none;color:black;border-radius:7px"
                                                                href="{{ route('user_car_edit', ['id' => $item->id]) }}">Edit</a>
                                                        </td>
                                                        <td style="line-height: 40px"><a
                                                                class="btn btn-outline-danger w-100 "
                                                                style="text-decoration: none;color:black;border-radius:7px"
                                                                href="{{ route('user_car_delete', ['id' => $item->id]) }}"
                                                                onclick="return confirm('Are you sure?')">Delete</a></td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection