@extends('index')
@section('title','Add Faq')
@section('main')

<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="card">
                    <div class="header">
                        <h2> ADD ADVERTISEMENT </h2><br>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('add_data') }}" enctype="multipart/form-data"
                        data-parsley-validate="">

                            {{ csrf_field() }}
                            {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="datetime-local" name="start_date" class="form-control"
                                            id="from_date">
                                    </div>
                                </div>
                            </div> --}}  

                            <select class="js-example-basic-single" name="advertisement_type" id="advertisement_type"
                                onchange="changeUser(this)">
                                <option>select advertisement type</option>
                                <option value="normal">normal</option>
                                <option value="celebrity">celebrity</option>
                            </select>
                            <br><br>
                            <label for="media">Media</label>

                            <input type="file" class="form-control" id="media" name="media"
                                accept="file_extension|video/*|image" placeholder="upload image" data-parsley-required
                                required multiple /><span style="color: red">@error('media'){{$message}}@enderror</span>

                                <label for="name">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" class="form-control" required
                                            placeholder="Enter name"  >
    
                                    </div>
                                </div>

                                <label for="start_date">Start Duration</label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="datetime-local" name="start_date" class="form-control"
                                            id="from_date" > 
                                        </div>
                                    </div>
                                </div>
                                <label for="end_date">End Duration</label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="datetime-local" name="end_date" class="form-control"
                                           >
                                        </div>
                                    </div>
                                </div>
    
                                <label for="name">Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="link" id="link" class="form-control" required
                                            placeholder="Enter link" >
    
                                    </div>
                                </div>
    
                                <br>
                                <div class="text-center">
                                    <a href="{{route('advertisement_list')}}"
                                        class="btn btn-raised btn-primary m-t-15 waves-effect"
                                        style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                                    <button class="btn btn-raised btn-primary m-t-15 waves-effect"
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
</body>
</html>
@endsection