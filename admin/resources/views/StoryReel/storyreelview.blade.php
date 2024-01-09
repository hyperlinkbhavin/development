@extends('index')
@section('title', 'Manage Reel')
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
                                        <a href="{{ URL::previous() }}"
                                            class="btn btn-raised waves-effect waves-float waves-red text-left"><i
                                                class="zmdi zmdi-arrow-left"></i></a>
                                    </div>
                                </div>

                                <div class="member-img" style="margin-top:0px !important;">
                                    <!-- margin-right:1000px; -->

                                </div>
                                <div class="body">
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="m-t-0"><b>Provide Story Information</b></h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-box m-t-20 text-left m-l-10">
                                                <div class="p-20">
                                                    <div class="about-info-p">
                                                        <strong>Created date</strong>
                                                        <p class="text-muted">{{ $user['insert_date'] }}</p>
                                                        <strong>Media Name</strong>
                                                        <p class="text-muted">{{ $user['media_type'] }}</p>
                                                        <strong>Description</strong>
                                                        <p class="text-muted">{{ $user['caption'] }}</p>
                                                        <strong>Total Views</strong>
                                                        <p class="text-muted">{{ $views->count() }}</p>
                                                        <strong>Total Likes</strong>
                                                        <p class="text-muted">{{ $likes->count() }}</p>
                                                    
                                                        <strong>Media</strong>
                                                        <br>
                                                        {{-- <p class="text-muted">{{$user['media_type']}}</p> --}}
                                                        @if ($user->media_type == 'image')
                                                            <img src="{{ "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/provider_story/" .
                                                                $user->media_name }}"
                                                                height="700px" width="500px" />
                                                        @else
                                                            <div id="video-player">
                                                                <video width="700px" height="500px" controls>
                                                                    <source
                                                                        src="{{ "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/provider_story/" .
                                                                            $user->media_name }}"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                        @endif



                                                        {{-- <strong>Provider Name</strong>
                                                    <br>
                                                    <p class="text-muted">{{$product->first_name}}</p> --}}
                                                    </div>
                                                    <br>
                                             


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
                                {{-- @foreach ($product as $pro)
                                                    <p class="text-muted ">{{$pro['p_name']}}</p>
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
    {{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> --}}
    </body>

    </html>
@endsection
