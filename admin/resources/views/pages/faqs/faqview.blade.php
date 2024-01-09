@extends('index')
@section('title','Faq View')
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
                                    <h4 class="m-t-0"><b>FAQ Information</b></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-box m-t-20 text-left m-l-10">
                                        <div class="p-20">
                                            <div class="about-info-p">
                                                <strong>Question</strong>
                                                <br>
                                                <p class="text-muted" >{{$user['question']}}</p>
                                                <strong>Answer</strong>
                                                <p class="text-muted" >{{$user['answer']}}</p>

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
{{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
</body>
</html>
@endsection