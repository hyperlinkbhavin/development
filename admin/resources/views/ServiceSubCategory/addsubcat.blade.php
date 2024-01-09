@extends('index')
@section('title', 'Add SubCategory')
@section('main')


    <section class="content">

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    <div class="card">
                        <div class="header">
                            <h2> ADD SERVICE SUBCATEGORY </h2><br>

                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('add_subcategories') }}" enctype="multipart/form-data"
                                data-parsley-validate="">
                                <div class="body" style="margin-left: -19px;">
                                    {{-- <select class="js-example-basic-single" name="category_id" id="user_names" data-parsley-min="1" data-parsley-min-message="This field is required"
                                data-parsley-errors-container= "#error_category"
                                onchange="changeUser(this)" required="">
                                    <option >Select Category</option>
                                    @foreach ($users as $k)
                                    {{$k}}
        
                                    <option value="{{$k->id}}">{{$k->name}}
                                        </option>
                            @endforeach
                            </select> --}}
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <select style="margin-left: 20px !important; width: 300px;"
                                                class="form-control" name="category_id" id="user_names"
                                                data-parsley-required-message="Please select provider"
                                                data-parsley-errors-container="#error_category" required>
                                                <option>Select Category</option>
                                                @foreach ($users as $k)
                                                    {{ $k }}

                                                    <option value="{{ $k->id }}">{{ $k->name }}
                                                    </option>
                                        </div>
                                        @endforeach

                                        </select>
                                    </div>

                                </div>

                                <span id="error_category"></span>
                        </div>
                        {{ csrf_field() }}
                        <label for="name">SubCategory Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" id="name" class="form-control" required
                                    placeholder="Enter service category" data-parsley-errors-container=".faq_que_errorrrrr"
                                    data-parsley-required-message="This field is required" required="">

                            </div>
                        </div>

                        <br>
                        <div class="text-center">
                            <a href="{{ route('service_subcategories') }}"
                                class="btn btn-raised btn-primary m-t-15 waves-effect"
                                style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                            <button class="btn btn-raised btn-primary m-t-15 waves-effect"
                                style="background-color:#8f75d3;border:none;height:40px;width:80px"> Submit </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    {{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
    </body>

    </html>
@endsection
