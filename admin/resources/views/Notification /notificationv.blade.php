@extends('index')
@section('title','Notification View')
@section('main')
<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="card">
                    <div class="header">
                        <h4 class="page-title">Notification</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="loader" class="lds-dual-ring hidden overlay"></div>
                                <div class="card-box">
                                    <form id="myform" class="form-horizontal" enctype="multipart/form-data"
                                        action="" role="form" method="POST" data-parsley-validate="">
                                        @csrf
                                        <div id="example" role="application">
                                            <div class="form-group">
                                                <div class="col-md-10">

                                                    
                                                    @if (\Session::get('success'))
                                                    <div class="alert alert-success alert-dismissable zoomIn animated">
                                                        <button aria-hidden="true" data-dismiss="alert" class="close"
                                                        type="button">×</button>{{ \Session::get('success') }}<a
                                                        class="alert-link" href="#"></a>
                                                      </div>
                                                  @endif
                                                  {{ \Session::forget('success') }}
                                                    <select class="form-control" id="sponsor_ids" multiple="multiple"
                                                        name="users_list[]" style="width: 100%;" required=''>

                                                        @foreach($users as $k)
                                                        {{$k}}

                                                        <option value="{{$k->id}}">{{$k->first_name}} {{$k->last_name}}
                                                            ( {{$k->email}} )</option>
                                                </div>
                                                @endforeach

                                                </select>
                                                <div class="demo-checkbox mt-2">
                                                    <input type="checkbox" id="basic_checkbox_8">
                                                    <label for="basic_checkbox_8">Select All User</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" data-parsley-required
                                                        name="notification_message"
                                                        placeholder="Enter notification message">
                                                    <span
                                                        style="color: red">@error('notification_message'){{$message}}@enderror</span><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">

                                            <button class="btn btn-primary waves-effect waves-light"
                                                style="float: left;margin-left:10px;" type="submit">
                                                Submit

                                            </button>
                                            <a style="margin-top: -1px;margin-left:10px" href="{{route('Dashboard')}}"
                                                class="btn btn-raised btn-primary m-t-15 waves-effect"
                                                style="background-color:#8f75d3;border:none;height:40px;width:80px">
                                                Back </a>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</section>

{{-- 
</body>

</html> --}}
@endsection