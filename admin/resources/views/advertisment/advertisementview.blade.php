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
                                    <h4 class="m-t-0"><b>Advertisement Information</b></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                    <div class="card-box m-t-20 text-left m-l-10">
                                        <div class="p-20">
                                            <div class="about-info-p">
                                                {{-- <strong>Advertisement Type</strong>
                                                <p class="text-muted" >{{$user['advertisement_type']}}</p> --}}
                                                    <strong>Media Type</strong>
                                                <p class="text-muted" >{{$user['media_type']}}</p>
                                                <div class="about-info-p">
                                                    <strong>Media</strong>
                                                    <br>
                                                    @if($user->media_type =='image')
                                                    <img src="{{"
                                                        https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/banner/".$user->media
                                                    }}" height="100px" width="120px"/>
                                                    @else
                                                    <div id="video-player"> 
                                                        <video width="150" height="100" controls> 
                                                            <source src="{{ "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/banner/".$user->media }}" type="video/mp4"> 
                                                              Your browser does not support the video tag. 
                                                       </video> 
                                                    </div> 
                                                    @endif
                                                </div>
                                                {{-- <strong>Reel</strong>
                                                <br>
                                                <p class="text-muted" >{{$user['reel']}}</p> --}}
                                                {{-- <strong>Description</strong>
                                                <p class="text-muted" >{{$user['description']}}</p> --}}

                                            </div>
                                            <br>
                                            <div class="about-info-p">
                                                <strong>Start Duration</strong>
                                                <br>
                                                <p class="text-muted">{{$user['start_date']}}</p>
                                            </div><div class="about-info-p">
                                                <strong>End Duration</strong>
                                                <br>
                                                <p class="text-muted">{{$user['end_date']}}</p>
                                            </div> </div><div class="about-info-p">
                                                <strong>Link</strong>
                                                <br>
                                                <p class="text-muted">{{$user['link']}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>Banner Name</strong>
                                                <br>
                                                <p class="text-muted">{{$user['name']}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>Description</strong>
                                                <br>
                                                <p class="text-muted">{{$user['description']}}</p>
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