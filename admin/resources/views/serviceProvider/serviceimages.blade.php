
@extends('index')
@section('title','Provider View')
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
                                        <h4 class="m-t-0"><b>Provider Images</b></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-box m-t-20 text-left m-l-10">
                                            <div class="p-20">
                                                <div class="about-info-p">
                                                    <input type="hidden" value="{{$user}}" id="service_id">

                                                    <div class="about-info-p">
                                                        <strong>Images</strong>
                                                        <br>
                                                        @foreach($user as $pro)
                                                        {{-- <p class="text-muted ">{{$pro['image']}}</p>  --}}
                                                    <img src="{{ "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/service/".$pro->image }}" height="100px" width="120px"/>

                                                       {{-- <img src="{{ asset('/resources/images/' . $pro->image) }}" height="100px" width="100px"/> --}}

                                                         @endforeach

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

</html>
@endsection