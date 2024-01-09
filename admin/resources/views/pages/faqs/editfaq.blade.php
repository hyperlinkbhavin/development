@extends('index')
@section('title','Edit Faq')
@section('main')
<div class="col-sm-6">
    <h1 class="m-0">Add FAQ</h1>
</div><!-- /.col -->

<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    
                    <div class="header">
                        <h2> FAQ  </h2><br>
                        <small> Add Question & Answer Here</small>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_post_faq') }}" enctype="multipart/form-data" data-parsley-validate="">
                            <input name="id" value="{{$user['id']}}" hidden>

                            {{ csrf_field() }}
                            <label for="question">Question</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="question" id="question" class="form-control" value="{{$user['question']}}" required placeholder="Enter your question" data-parsley-errors-container=".faq_que_errorrrrr" data-parsley-required-message="Question field is required" required="">
                                    <div class="faq_que_errorrrrr"></div>
                                </div>
                            </div>
                            <label for="answer">Answer</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="answer" id="answer" class="form-control" value="{{$user['answer']}}" required placeholder="Enter your answer" data-parsley-errors-container=".faq_ans_errorrrrr" data-parsley-required-message="Answer field is required" required="">
                                    <div class="faq_ans_errorrrrr"></div>
                                </div>
                            </div>
                            <br>
                            <div class="text-center">
                            <a href="{{route('faqlist')}}" class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
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