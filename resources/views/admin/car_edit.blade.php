@extends('layouts.admin')

@section('title', 'Edit Car')

@section('javascript')
    <script src="{{ asset('assets') }}/js/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div style="background-color: white" class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">

                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Car</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-header border">
                    <h3 class="card-title">Edit Car</h3>
                </div>

                <div class="card-body border">
                    <div class="card">
                        <form class="form-horizontal" action="{{ route('admin_car_update', ['id' => $data->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row" data-select2-id="12">
                                    <label class="col-sm-2 text-right control-label col-form-label">Category</label>
                                    <div class="col-md-9" data-select2-id="11">
                                        <select required name="category_id"
                                            class="select2 form-control custom-select select2-hidden-accessible"
                                            style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1"
                                            aria-hidden="true">
                                            <option value="0" data-select2-id="3">Select Category</option>
                                            @foreach ($dataList as $rs)
                                                <option value="{{ $rs->id }}" @if ($rs->id == $data->category_id) selected="selected"@endif 
                                                                              data-select2-id="17"> {{\App\Http\Controllers\Admin\CategoryController::getParentsTree($rs,$rs->title)}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname"
                                        class="col-sm-2 text-right control-label col-form-label">Brand</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->brand }}" type="text" name="brand" class="form-control"
                                            id="brand" placeholder="Brand Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname"
                                        class="col-sm-2 text-right control-label col-form-label">Model</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->model }}" type="text" name="model" class="form-control"
                                            id="model" placeholder="Model Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname"
                                        class="col-sm-2 text-right control-label col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->price }}"  type="number" name="price" class="form-control" id="price"
                                            placeholder="Price Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-sm-2 text-right control-label col-form-label">Year</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->year }}" type="text" name="year" class="form-control"
                                            id="year" placeholder="Year Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-sm-2 text-right control-label col-form-label">Engine
                                        Power</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->engine_power }}" type="number" name="engine_power"
                                            class="form-control" id="engine_power" placeholder="Engine Power Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-sm-2 text-right control-label col-form-label">Fuel
                                        Type</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->fuel_type }}" type="text" name="fuel_type"
                                            class="form-control" id="fuel_type" placeholder="Fuel Type Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname"
                                        class="col-sm-2 text-right control-label col-form-label">Color</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->color }}" type="text" name="color" class="form-control"
                                            id="color" placeholder="Color Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-sm-2 text-right control-label col-form-label">Licance
                                        Plate</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->licance_plate }}" type="text" name="licance_plate"
                                            class="form-control" id="licance_plate" placeholder="Licance Plate Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-sm-2 text-right control-label col-form-label">Gear
                                        Type</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->gear_type }}" type="text" name="gear_type"
                                            class="form-control" id="gear_type" placeholder="Gear Type Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname"
                                        class="col-sm-2 text-right control-label col-form-label">Keywords</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->keywords }}" type="text" name="keywords" class="form-control"
                                            id="keywords" placeholder="Keywords Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname"
                                        class="col-sm-2 text-right control-label col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control" id="editor1" rows="10" cols="80"
                                            placeholder="Description Here">
                                        {{ $data->description }}
                                        </textarea>
                                        <script>
                                            CKEDITOR.replace('editor1');

                                        </script>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname"
                                        class="col-sm-2 text-right control-label col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->title }}" type="text" name="title" class="form-control"
                                            id="title" placeholder="Title Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname" class="col-sm-2 text-right control-label col-form-label">Brand
                                        ID</label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->brand_id }}" type="text" name="brand_id" class="form-control"
                                            id="brand_id" placeholder="Brand ID Here">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname" class="col-sm-2 text-right control-label col-form-label">Slug
                                        </label>
                                    <div class="col-sm-9">
                                        <input required value="{{ $data->slug }}" type="text" name="slug" class="form-control" id="slug"
                                            placeholder="Slug Here">
                                    </div>
                                </div>
                                <div class="form-group row" data-select2-id="12">
                                    <label class="col-sm-2 text-right control-label col-form-label">Status</label>
                                    <div class="col-md-9" data-select2-id="11">
                                        <select required value="{{ $data->status }}" name="status"
                                            class="select2 form-control custom-select select2-hidden-accessible"
                                            style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1"
                                            aria-hidden="true">
                                            <option data-select2-id="3" @if($data->status =='False') selected="selected" @endif >False</option>
                                        <option value="True" @if($data->status =='True') selected="selected" @endif data-select2-id="17" >True</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="lname"
                                        class="col-sm-2 text-right control-label col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input  type="file" name="image" class="form-control" id="image">
                                        @if ($data->image)
                                            <img src="{{ Storage::url($data->image) }}" style="height: 150px;" alt="">
                                        @endif
                                    </div>
                                </div>

                                

                            </div>
                            <div class="border-top">
                                <div class="col-sm-2 text-right control-label col-form-label card-body">
                                    <button type="submit" class="btn btn-primary">Edit Car</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-footer border">Footer

                </div>
            </div>
        </div>



    </div>
@endsection



@section('footer')
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets') }}/admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets') }}/admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets') }}/admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets') }}/admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{ asset('assets') }}/admin/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('assets') }}/admin/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('assets') }}/admin/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('assets') }}/admin/dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="{{ asset('assets') }}/admin/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="{{ asset('assets') }}/admin/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="{{ asset('assets') }}/admin/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();

    </script>
@endsection
