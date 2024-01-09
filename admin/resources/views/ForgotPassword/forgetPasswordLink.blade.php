<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Reset Password</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
{{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{asset('public/assets/css/parsley.css')}}">

<link rel="stylesheet" href="{{asset('public/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('public/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('public/assets/css/authentication.css')}}">
<link rel="stylesheet" href="{{asset('public/assets/css/color_skins.css')}}">
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
                                <h1>Reset Your Password</h1>
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
                            type="button">×</button>{{ \Session::get('success') }}<a
                            class="alert-link" href="#"></a>
                          </div>
                      @endif
                      {{ \Session::forget('success') }}
                      @if (\Session::get('error'))
                      {{-- <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"> --}}
                        <div class="alert alert-danger alert-dismissable zoomIn animated">
                            <button aria-hidden="true" data-dismiss="alert" class="close"
                            type="button">×</button>{{ \Session::get('error') }}<a
                            class="alert-link" href="#"></a>
                          </div>
                      {{-- </div> --}}
                    @endif
                        </div>
                 
                        <form class="col-lg-12"  action="{{ route('reset.password.post') }}" method="POST" data-parsley-validate="">
                            {{-- <input name="id" value="{{$user[0]['id']}}" hidden> --}}

                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            {{-- <h5 class="title">Sign in to your Account</h5> --}}
                            <div class="form-group form-float">
                                
                                <div class="form-line">
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus >
                                    <label class="form-label">Email</label>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
  
                                </div>
                                <span id="error_email"></span>
                            </div>
                            <div class="form-group form-float">
                                
                                <div class="form-line">
                                    <input type="password" id="password" data-parsley-type="password" data_parsley_pattern = "^[a-z@.! # $ % & ' * + - / = ? ^ _ ` { | } ~]+)?$" name="password" class="form-control" data-parsley-required >
                                    <label class="form-label">New Password</label>
                                </div>
                                <span id="error_email"></span>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" name="confirm_new_password" data-parsley-errors-container="#error_password"  data-parsley-equalto-message="Confirm Password should match new password"  data-parsley-trigger = "keyup" data-parsley-equalto="#password" class="form-control" data-parsley-required>
                                    <label class="form-label">Confirm Password</label>
                                </div>
                                <span id="error_password"></span>
                            </div>

                        
                            @if (session('loginError'))
                            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                                <div class="alert alert-success">
                                  <h3> {{session('loginError')}}</h3>
                                </div>
                            </div>
                          @endif

                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-raised btn-primary waves-effect">Reset Password</button>
                                {{-- <a href="sign-up.html" class="btn btn-raised btn-default waves-effect">SIGN UP</a>                         --}}
                            </div>
                        </form>
                                          
                    </div>
                </div>
            </div>
        </div>
        
     
<!-- Jquery Core Js --> 
<script src="{{asset('public/assets/js/parsley.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<script src="{{asset('public/assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<script src="{{asset('public/assets/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>
</html>
