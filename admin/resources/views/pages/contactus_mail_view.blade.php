@extends('index')
@section('title','Add Faq')
@section('main')

<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="card">
                    <div class="header">
                        <h2> CONTACTUS MAIL  </h2><br>
                        {{-- <small> Add Question & Answer Here</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('send_mail') }}" enctype="multipart/form-data" data-parsley-validate="">
                            <input type="hidden" name="id" value="{{ $user['id'] }}">
                          
                            {{ csrf_field() }}
                          
                            <label for="subject">Suject</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="subject" id="subject" class="form-control" required placeholder="Enter your subject" data-parsley-errors-container=".subject" data-parsley-required-message="Question field is required" required="">
                                    <div class="subject"></div>
                                </div>
                            </div>
                            <label for="message">Message</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="message" id="message" class="form-control" required placeholder="Enter your message" data-parsley-errors-container=".message" data-parsley-required-message="message field is required" required="">
                                    <div class="message"></div>
                                </div>
                            </div>
                            <br>
                            <div class="text-center">
                            <a href="{{route('contactus')}}" class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
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