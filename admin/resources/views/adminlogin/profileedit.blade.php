@extends('index')
@section('title', 'Edit Profile')
@section('main')


    <section class="content">

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    <div class="card">
                        <div class="header">
                            <h2> Edit Profile </h2><br>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile_update') }}" enctype="multipart/form-data"
                                data-parsley-validate="">
                                <input name="id" value="{{ $user['id'] }}" hidden>
                                {{ csrf_field() }}
                                <label for="question">Name</label>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="email" id="email" data-parsley-type="email"
                                            class="form-control" value="{{ $user['email'] }}" required
                                            placeholder="Enter your email"
                                            data-parsley-required-message="This field is required" required="">
                                    </div>
                                </div>

                                <br>
                                <div class="text-center">
                                    <a href="{{ route('profile') }}" class="btn btn-raised btn-primary m-t-15 waves-effect"
                                        style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                                    <button class="btn btn-raised btn-primary m-t-15 waves-effect"
                                        style="background-color:#8f75d3;border:none;height:40px;width:80px"> Submit
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
    </body>

    </html>
@endsection
