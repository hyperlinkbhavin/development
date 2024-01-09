@extends('index')
@section('title','Customer View')
@section('main')
<section class="content">
   
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 mt-5">
                    <div class="card member-card">
                        <div class="header">
                            <div class="col-12 text-left">
                                <a href="{{ URL::previous() }}"  class="btn btn-raised waves-effect waves-float waves-red text-left"><i class="zmdi zmdi-arrow-left"></i></a>
                            </div>
                        </div>
                  
                        <div class="member-img" style="margin-top:0px !important;">
                            <!-- margin-right:1000px; -->
                           
                        </div>
                        <div class="body">
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="m-t-0"><b>User Information</b></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-box m-t-20 text-left m-l-10">
                                        <div class="p-20">
                                            <div class="about-info-p">
                                                <strong>Profile Image</strong><br>
                                                <img src="{{ "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/user/".$user->profile_image }}" height="100px" width="120px"/><br><br>
                                                <strong>Registered date</strong>
                                                <p class="text-muted" >{{$user['insert_date']}}</p>
                                                <div class="about-info-p">
                                                    {{-- <strong>Image</strong>
                                                    <br>
                                                   
                                                    <img src="{{ "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/user/".$user->profile_image }}" height="100px" width="120px"/>
                                                </div><br> --}}
                                                <strong>User Name</strong>
                                                <br>
                                                <p class="text-muted" >{{$user['first_name']}} {{$user['last_name']}}</p>
                                                

                                            </div>
                                            
                                            <div class="about-info-p">
                                                <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">{{$user['email']}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>Mobile Number</strong>
                                                <br>
                                                <p class="text-muted">{{$user['country_code']}} {{$user['mobile']}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>City</strong>
                                                <br>
                                                <p class="text-muted">{{$user['city']}}, {{$country->c_name}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>Coins</strong>
                                                <br>
                                                <p class="text-muted">{{$coinValue}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>IP Address</strong>
                                                <br>
                                                <p class="text-muted">{{$ip[0]['ip']}}</p>
                                            </div>    
                                             <div class="about-info-p">
                                                <strong>Device Type</strong>
                                                <br>
                                                <p class="text-muted">{{$ip[0]['device_type']}}</p>
                                            </div>
                                            {{-- <div class="about-info-p">
                                                <strong>Date of Birth</strong>
                                                <br>
                                                <p class="text-muted">{{$user->dob}}</p>
                                            </div>
                                             --}}
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="body">
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="m-t-0"><b>Order Information</b></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-box m-t-20 text-left m-l-10">
                                        <div class="p-20">
                            <div class="about-info-p">
                                <strong>Product Name</strong>
                                <br> --}}
                                {{-- @foreach($product as $pro)
                                <p  class="text-muted ">{{$pro['p_name']}}</p>
                                @endforeach --}}
                            </div>
                                        </div>
                                    </div>
                                </div>
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
{{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
</body>
</html>
@endsection