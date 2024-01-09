@extends('index')
@section('title', 'Dashboard')
@section('main')

    <section class="content blog-page">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2> Dashboard

                    </h2>
                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-blue div1">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $customer->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Users</p>
                            </center>
                            <center><a href="{{ route('customers') }}"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect"
                                    style="background: linear-gradient(45deg, #72c2ff, #86f0ff) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                                margin-top: 5px;">More
                                    info <i class="fas fa-arrow-circle-right"></i></a></center>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-parpl div2">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $provider->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Providers</p>
                            </center>
                            <center><a href="{{ route('service_provider') }}"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect"
                                    style="background: linear-gradient(45deg, #a890d3, #edbae7) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                                margin-top: 5px;">More
                                    info <i class="fas fa-arrow-circle-right"></i></a></center>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-seagreen div3">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $Category->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Categories</p>
                            </center>
                            <center><a href="{{ route('service_categories') }}"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect"
                                    style="    background: linear-gradient(45deg, #8ed8ec, #85f7b5) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                                margin-top: 5px;">More
                                    info <i class="fas fa-arrow-circle-right"></i></a></center>

                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-amber div4">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $SubCategory->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Sub Categories</p>
                            </center>
                            <center><a href="{{ route('service_subcategories') }}"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect"
                                    style="background: linear-gradient(45deg, #fda582, #f7cf68) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                                margin-top: 5px;">More
                                    info <i class="fas fa-arrow-circle-right"></i></a></center>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-amber div5">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $Advertisement->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Advertisements Banners</p>
                            </center>
                            <center><a href="{{ route('advertisement_list') }}"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect"
                                    style="background: linear-gradient(45deg, #fda582, #f7cf68) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                                margin-top: 5px;">More
                                    info <i class="fas fa-arrow-circle-right"></i></a></center>
                        </div>

                    </div>
                </div>


                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-blue div6">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $reel->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Story</p>
                            </center>
                            <center><a href="{{ route('reel_list') }}"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect"
                                    style="background: linear-gradient(45deg, #72c2ff, #86f0ff) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                            margin-top: 5px;">More
                                    info <i class="fas fa-arrow-circle-right"></i></a></center>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Jquery Core Js -->
    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <script src="{{ asset('public/assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <script src="{{ asset('public/assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('public/assets/bundles/morrisscripts.bundle.js') }}"></script><!-- Morris Plugin Js -->
    <script src="{{ asset('public/assets/bundles/sparkline.bundle.js') }}"></script> <!-- Sparkline Plugin Js -->
    <script src="{{ asset('public/assets/bundles/knob.bundle.js') }}"></script> <!-- Jquery Knob Plugin Js -->

    <script src="{{ asset('public/assets/bundles/mainscripts.bundle.js') }}"></script><!-- Custom Js -->
    <script src="{{ asset('public/assets/js/pages/blog/blog.js') }}"></script>
    <script src="{{ asset('public/assets/js/pages/maps/jvectormap.js') }}"></script>
    <script src="{{ asset('public/assets/js/pages/charts/jquery-knob.min.js') }}"></script>

    <script>
        $('.count').each(function() {
            var $this = $(this);
            jQuery({
                Counter: 0
            }).animate({
                Counter: $this.text()
            }, {
                duration: 1000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.ceil(this.Counter));
                }
            });
        });
    </script>
    </body>

    </html>
@endsection
