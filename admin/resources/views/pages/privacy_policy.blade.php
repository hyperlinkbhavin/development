@extends('index')
@section('title','Privacy Policy')
@section('main')


<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="card">
                    <div class="header">
                        <h2>Privacy Policy </h2>    
                    </div>
                    <div class="header">
                        <h2>&nbsp; <small> Add And Update Privacy Policy</small> </h2>
                        @if (\Session::get('success'))
                        <div class="alert alert-success alert-dismissable zoomIn animated col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-2" style="margin-left: 1105px;"
                        id="message">
                            <button aria-hidden="true" data-dismiss="alert" class="close"
                                type="button">×</button>{{ \Session::get('success') }}<a
                                class="alert-link" href="#"></a>
                        </div>
                        @endif
                    </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('update_page') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="page_keyword" value="{{$privacy_pages->keyword}}">
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <textarea required id="ckeditor" name="contents" class="form-control" rows="100" placeholder="Content">{{$privacy_pages->content}}</textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{route('dashboard')}}" class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                                    <input type="submit" href="{{route('privacy_policy')}}" class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px" value="Submit"> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
</section>
<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()
    })
</script>
{{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
</body>
</html>
@endsection