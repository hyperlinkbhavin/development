@extends('index')
@section('title','form')
@section('main')



    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                   
                </div>           
            </div>
        </div>
        <div class="container-fluid">
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                    <div class="card">
                        <div class="header">
                            <h2>Change Password </h2>
                           
                        </div>
                        <div class="body">
                            {{-- <h2 class="card-inside-title">User data Form</h2> --}}
                            <div class="col-12 text-left">
                                {{-- <a href="{{ URL::previous() }}"  class="btn btn-raised waves-effect waves-float waves-red text-left"><i class="zmdi zmdi-arrow-left"></i></a> --}}
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <form class="col-lg-12" action="{{ route('update_password') }}" method="post" data-parsley-validate="">
                                        @csrf
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="current_password" id="current_password" class="form-control" data-parsley-trigger = "keyup" placeholder="Current Password" data-parsley-required>
                                          
                                            {{-- @if($response['error'] = 1)
                                            <span style="color: red">Please Enter Valid Current Password</span><br>
                                            @endif    --}}

                                                <span style="color: red">@error('current_password'){{$message}}@enderror</span><br>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" data-parsley-trigger = "keyup" data-parsley-required>
                                                <span style="color: red">@error('new_password'){{$message}}@enderror</span><br>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="confirm_new_password" id="confirm_new_password"  data-parsley-equalto-message="Confirm Password should match new password"  data-parsley-trigger = "keyup" data-parsley-equalto="#new_password" class="form-control" placeholder="Confirm New Password" required>
                                                <span style="color: red">@error('confirm_new_password'){{$message}}@enderror</span><br>
                                            </div>
                                        </div>
                                       
            
                                        <div class="form-group">
                                            <div class="text-center">
                                                <a href="{{route('dashboard')}}" class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                                                <input type="submit"  class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px" value="Update">  
                                                <!-- <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect">SUBMIT</button> -->
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
    {{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
</body>
</html>
    
@endsection