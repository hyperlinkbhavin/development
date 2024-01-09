@extends('index')
@section('title', 'Add Faq')
@section('main')

    <section class="content">

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    <div class="card">
                        <div class="header">
                            <h2> ADD SUB ADMIN </h2><br>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('add_sub_admin') }}" enctype="multipart/form-data"
                                data-parsley-validate="">

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-lg-7">

                                        <label for="name" style="color:black">Sub Admin Name</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="name" id="name"
                                                    style="margin-top: -10px" class="form-control" 
                                                    placeholder="Enter name" >

                                            </div>
                                            <span style="color: red">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span><br>

                                        </div>
                                    </div>
                                    <div class="col-lg-7">

                                        <label for="email" style="color:black">Sub Admin Email</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="email" id="email"
                                                    style="margin-top: -10px" data-parsley-type="email" class="form-control"
                                                    required placeholder="Enter email" required="">
                                            </div>
                                            <span style="color: red">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <label for="country_code" style="color:black">Country Code</label>
                                        <div class="form-group">
                                            <div class="">
                                                <select class="js-example-basic-single" name="country_code"
                                                    id="country_code" data-parsley-min="1"
                                                    data-parsley-min-message="This field is required"
                                                    data-parsley-errors-container="#error_category" required="">
                                                    <option>Select Country Code</option>
                                                    @foreach ($code as $k)
                                                        {{ $k }}

                                                        <option value="{{ $k->phonecode }}">{{ $k->phonecode }}

                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="error_category"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="margin-left: 20px !important">
                                        <label for="phone" style="color:black">Sub Admin Phone Number</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="phone" style="margin-top: -10px"
                                                    id="phone" data-parsley-type="number" data-parsley-maxlength="15"
                                                    class="form-control" required placeholder="Enter phone number"
                                                    required="">

                                            </div>
                                            <span style="color: red">
                                                @error('phone')
                                                    {{ $message }}
                                                @enderror
                                            </span><br>
                                        </div>
                                    </div>
                                </div>
                        </div>


                        <div class="text-center">
                            <a href="{{ route('view_admin_list') }}" class="btn btn-raised btn-primary m-t-15 waves-effect"
                                style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                            <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect"
                                style="background-color:#8f75d3;border:none;height:40px;width:80px"> Submit
                            </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}

@endsection
