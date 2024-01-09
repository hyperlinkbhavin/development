
@extends('index')
@section('title','Edit Faq')
@section('main')


<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="card">
                    
                    <div class="header">
                        <h2> Edit SubCategories  </h2><br>
              
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_subcategories') }}" enctype="multipart/form-data" data-parsley-validate="">
                            <input name="id" value="{{$user['id']}}" hidden>

                            {{ csrf_field() }}
                            <div class="body" style="margin-left: -19px;">
                                {{-- <select class="form-control" name="category_id" id="user_names" data-parsley-min="1" data-parsley-min-message="This field is required"
                                data-parsley-errors-container= "#error_category"
                                onchange="changeUser(this)" required="">
                                    <option >Select Category</option>
                                    @foreach($cat as $k)
                                    {{$k}}
        
                                    <option value="{{$k->id}}" <?php if ($k->id == $user['category_id']) {
                                        echo 'selected';
                                    }?>>{{$k->name}}
                                        </option>
                            @endforeach
                            </select> --}}

                            <select style="margin-left: 20px !important; width: 300px;"
                            class="form-control" name="category_id" id="user_names"
                            data-parsley-required-message="Please select provider"
                            data-parsley-errors-container="#error_category" required>
                            <option >Select Category</option>
                                    @foreach($cat as $k)
                                    {{$k}}
        
                                    <option value="{{$k->id}}" <?php if ($k->id == $user['category_id']) {
                                        echo 'selected';
                                    }?>>{{$k->name}}
                                        </option>
                    </div>
                    @endforeach

                    </select>

                            <span id="error_category"></span>
                            <br><br>
                            <label for="question">SubCategory Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="name" id="name" class="form-control" value="{{$user['name']}}" required placeholder="Enter SubCategory"  data-parsley-required-message="This field is required" required="">
                                    
                                </div>
                            </div>
                           
                            <br>
                            <div class="text-center">
                            <a href="{{route('service_subcategories')}}" class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                            <button  class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Submit </button>
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