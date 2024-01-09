<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>Bawabat Admin Panel</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    {{-- <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/assets/css/parsley.css') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/authentication.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/color_skins.css') }}">
    <style>
        .parsley-errors-list li {
            margin-right: 50px;
            color: red;
        }

        ul {
            list-style-type: none;
        }
    </style>
</head>

<body class="theme-orange">
    <div class="authentication">
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header slideDown">
                            {{-- <div class="logo"><img src="assets/images/logo.png" alt="Nexa"></div> --}}
                            <h1>Administrator Login</h1>
                            {{-- <ul class="list-unstyled l-social">
                                    <li><a href="#"><i class="zmdi zmdi-facebook-box"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-linkedin-box"></i></a></li>                            
                                    <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                </ul> --}}
                        </div>
                    </div>

                    <div class="col-lg-12">
                        @if (\Session::get('success'))
                            <div class="alert alert-success alert-dismissable zoomIn animated">
                                <button aria-hidden="true" data-dismiss="alert" class="close"
                                    type="button">×</button>{{ \Session::get('success') }}<a class="alert-link"
                                    href="#"></a>
                            </div>
                        @endif
                        {{ \Session::forget('success') }}
                        @if (\Session::get('error'))
                            {{-- <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"> --}}
                            <div class="alert alert-danger alert-dismissable zoomIn animated">
                                <button aria-hidden="true" data-dismiss="alert" class="close"
                                    type="button">×</button>{{ \Session::get('error') }}<a class="alert-link"
                                    href="#"></a>
                            </div>
                            {{-- </div> --}}
                        @endif
                    </div>
                    {{-- @if (\Session::get('success'))
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ \Session::get('success') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif --}}
                    {{-- {{ \Session::forget('success') }}
                        @if (\Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                {{ \Session::get('error') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif --}}
                    <form class="col-lg-12" id="sign_in" action="{{ route('adminLoginPost') }}" method="post"
                        data-parsley-validate="">
                        @csrf
                        <h5 class="title">Sign in to your Account</h5>
                        <div class="form-group form-float">

                            <div class="form-line">
                                <input type="email" id="input_email" data-parsley-type="email" name="email"
                                    data-parsley-required-message="Please insert your Email"
                                    data-parsley-errors-container="#error_email" class="form-control"
                                    data-parsley-required>
                                <label class="form-label">Email</label>
                            </div>
                            <span id="error_email"></span>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" name="password" data-parsley-errors-container="#error_password"
                                    data-parsley-required-message="Please insert your password" class="form-control"
                                    data-parsley-required>
                                <label class="form-label">Password</label>
                            </div>
                            <span id="error_password"></span>
                        </div>

                        <input type="hidden" class="timezone">
                        {{-- <div>
                                    <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-cyan">
                                    <label for="rememberme">Remember Me</label>
                                </div>                         --}}
                        @if (session('loginError'))
                            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                                <div class="alert alert-success">
                                    <h3> {{ session('loginError') }}</h3>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-raised btn-primary waves-effect">SIGN IN</button>
                            {{-- <a href="sign-up.html" class="btn btn-raised btn-default waves-effect">SIGN UP</a>                         --}}
                        </div>

                        <div class="col-lg-12 mt-4">
                            <a href="{{ url('view') }}">Forgot Your Password ?</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- Jquery Core Js -->
    <script src="{{ asset('public/assets/js/parsley.js') }}"></script>

    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('public/assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('public/assets/bundles/mainscripts.bundle.js') }}"></script><!-- Custom Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#input_email').keyup(function() {
            this.value = this.value.toLowerCase();
        });
    </script>
</body>

</html>
