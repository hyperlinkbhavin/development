@extends('index')
@section('title', 'ContactUs View')
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
                                <form method="POST" action="{{ route('closed_status') }}" enctype="multipart/form-data"
                                    data-parsley-validate="">

                                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                                    {{ csrf_field() }}
                                    <div class="body">
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="m-t-0"><b>ContactUs Details</b></h4>
                                            </div>
                                        </div>
                                        <hr>
                                        {{-- <div class="row"> --}}
                                        {{-- <div class="col-md-6"> --}}
                                        <div class="card-box m-t-20 text-left m-l-10">
                                            <div class="p-20">
                                                <div class="about-info-p">
                                                    <strong>Full Name</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $user['first_name'] }}
                                                        {{ $user['last_name'] }}</p>
                                                </div>
                                                <br>
                                                <div class="about-info-p">
                                                    <strong>Email</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $user['email'] }}</p>
                                                </div>
                                                <br>

                                                <div class="about-info-p">
                                                    <strong>Subject</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $user['subject'] }}</p>
                                                </div>
                                                <br>


                                                <div class="about-info-p">
                                                    <strong>Description</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $user->description }}</p>

                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                    @if ($user->is_active == '2')
                                    @else
                                        @if (App\Helpers\common::has_permissions('admin.contactus_status'))
                                            <button class="btn btn-raised btn-primary m-t-15 waves-effect"
                                                style="background-color:#8f75d3;border:none;height:40px;width:120px;margin-bottom:20px">
                                                Complete
                                            </button>
                                        @endif
                                    @endif

                                </form>
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
