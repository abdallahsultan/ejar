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

@include('home.message')
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
                    <div class="card-header border">
                        <h3 class="card-title">إضافه سيارة</h3>
                    </div>

                    <div class="card-body border">
                        <div class="card">
                            <form class="form-horizontal" action="{{ route('user_car_store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group row" data-select2-id="12">
                                        <label class="col-sm-2 text-right control-label col-form-label">Category</label>
                                        <div class="col-md-9" data-select2-id="11">
                                            <select name="category_id" required>
                                                @foreach ($dataList as $rs)
                                                <option value="{{ $rs->id }}">
                                                    {{\App\Http\Controllers\Admin\CategoryController::getParentsTree($rs,$rs->title)}}
                                                </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Brand</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="brand" class="form-control" id="brand"
                                                placeholder="Brand Here">
                                        </div>
                                        @error('brand')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Model</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="model" class="form-control" id="model"
                                                placeholder="Model Here">
                                        </div>
                                        @error('model')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="price" class="form-control" id="price"
                                                placeholder="Price Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Year</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="year" class="form-control" id="year"
                                                placeholder="Year Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Engine
                                            Power</label>
                                        <div class="col-sm-9">
                                            <input required type="number" name="engine_power" class="form-control"
                                                id="engine_power" placeholder="Engine Power Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-2 text-right control-label col-form-label">Fuel
                                            Type</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="fuel_type" class="form-control" id="fuel_type"
                                                placeholder="Fuel Type Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Color</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="color" class="form-control" id="color"
                                                placeholder="Color Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname"
                                            class="col-sm-2 text-right control-label col-form-label">Licance
                                            Plate</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="licance_plate" class="form-control"
                                                id="licance_plate" placeholder="Licance Plate Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-2 text-right control-label col-form-label">Gear
                                            Type</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="gear_type" class="form-control" id="gear_type"
                                                placeholder="Gear Type Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname"
                                            class="col-sm-2 text-right control-label col-form-label">Keywords</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="keywords" class="form-control" id="keywords"
                                                placeholder="Keywords Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname"
                                            class="col-sm-2 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" class="form-control" id="editor1" rows="10"
                                                cols="80" placeholder="Description Here"></textarea>
                                            <script>
                                            CKEDITOR.replace('editor1');
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname"
                                            class="col-sm-2 text-right control-label col-form-label">Title</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="title" class="form-control" id="title"
                                                placeholder="Title Here">
                                        </div>
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname"
                                            class="col-sm-2 text-right control-label col-form-label">Brand
                                            ID</label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="brand_id" class="form-control" id="brand_id"
                                                placeholder="Brand ID Here">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-2 text-right control-label col-form-label">Slug
                                        </label>
                                        <div class="col-sm-9">
                                            <input required type="text" name="slug" class="form-control" id="slug"
                                                placeholder="Slug Here">
                                        </div>
                                    </div>
                                    <div class="form-group row" data-select2-id="12">
                                        <label class="col-sm-2 text-right control-label col-form-label">Status</label>
                                        <div class="col-md-9" data-select2-id="11">
                                            <select name="status" required>
                                                <option value="False" data-select2-id="3">False</option>
                                                <option value="True" data-select2-id="17">True</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lname"
                                            class="col-sm-2 text-right control-label col-form-label">Image</label>
                                        <div class="col-sm-9">
                                            <input required type="file" name="image"  id="image"
                                                placeholder="Brand ID Here">
                                        </div>
                                    </div>


                                </div>
                                <div class="border-top">
                                    <div class="col-sm-4 text-right control-label col-form-label card-body">
                                        <button type="submit" class="btn btn-primary">Add Car</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-footer border">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection