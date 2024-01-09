@extends('index')
@section('title','About Us')
@section('main')

<section class="content">

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="card">
                    <div class="header">
                        <h2>ABOUT US </h2>
                    </div>
                    <div class="header">
                        <h2>&nbsp; <small> Add And Update About Us Here</small> </h2>
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
                        <form method="POST" action="{{ route('update_page') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="page_keyword" value="{{$about_us->keyword}}">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <textarea required name="contents" id="ckeditor"
                                        placeholder="Content">{{strip_tags($about_us->content)}}</textarea>
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="{{route('dashboard')}}" class="btn btn-raised btn-primary m-t-15 waves-effect"
                                    style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                                <input type="submit" href="{{route('aboutus')}}"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect"
                                    style="background-color:#8f75d3;border:none;height:40px;width:80px" value="Submit">
                                <!-- <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect">SUBMIT</button> -->
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
{{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> --}}

</body>

</html>
@endsection