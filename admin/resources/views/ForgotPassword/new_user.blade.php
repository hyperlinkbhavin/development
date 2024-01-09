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
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/assets/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/intlTelInput.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">

    <link rel="stylesheet" href="{{ asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/authentication.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/color_skins.css') }}">
    <style>
        body {
            background-color: #ffffff;
            -moz-transition: all 0.5s;
            -o-transition: all 0.5s;
            -webkit-transition: all 0.5s;
            transition: all 0.5s;
            font-family: 'Muli', Arial, Tahoma, sans-serif;
            font-weight: 400;
            font-size: 15px;
        }

        .content {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card-body {
            width: 100%;
            /* Adjust the width as needed */
            max-width: 700px;
            /* Set a maximum width for better readability on larger screens */
        }

        .form-group .form-line {
            width: 800px;
            position: relative;
            border-bottom: 1px solid #ddd;
            margin-left: -216px;

        }
    </style>


    <section class="content">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                <img src={{ asset('public/assets/provider/Text_Black_copy_2.png') }} alt="Image Description" style="max-width: 100%; height: 50px; margin-left: -11px;">

                <h3>Sign Up as a Provider</h3>
                <h5>Please enter your personal info.<h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('addUserData') }}" enctype="multipart/form-data"
                                data-parsley-validate="">

                                {{ csrf_field() }}

                                {{-- <label for="first_name">First Name</label> --}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="first_name" id="first_name" class="form-control"
                                            required placeholder="First Name"
                                            data-parsley-required-message="first name field is required" required="">
                                        <span style="color: red; font-size: 10px !important;"> @error('first_name')
                                                {{ $message }}
                                            @enderror
                                        </span><br>
                                    </div>
                                </div>
                                {{-- <label for="first_name">Last Name</label> --}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="last_name" id="last_name" class="form-control"
                                            required placeholder="Last Name"
                                            data-parsley-required-message="last name field is required" required="">
                                        <span style="color: red">
                                            @error('last_name')
                                                {{ $message }}
                                            @enderror
                                        </span><br>

                                    </div>
                                </div>
                                {{-- <label for="first_name">Email</label> --}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="email" id="email" class="form-control"
                                            required placeholder="Email"
                                            data-parsley-required-message="email field is required" required="">
                                        <span style="color: red">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span><br>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            required placeholder="phone number"
                                            data-parsley-required-message="phone number field is required"
                                            required="">
                                        <span style="color: red">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span><br>
                                        <input type="hidden" name="dial_code" id="dial_code">
                                        <input type="hidden" name="iso" id="iso">

                                    </div>
                                </div>
                                {{-- <label for="city">City</label> --}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="city" id="city" class="form-control"
                                            required placeholder="City"
                                            data-parsley-required-message="city field is required" required="">
                                        <span style="color: red">
                                            @error('city')
                                                {{ $message }}
                                            @enderror
                                        </span><br>

                                    </div>
                                </div>

                                {{-- <label for="answer">Password</label> --}}
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="password"
                                            data-parsley-errors-container="#error_password" placeholder="Password"
                                            data-parsley-required-message="Please insert your password"
                                            class="form-control" data-parsley-required>
                                        <span style="color: red">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span><br>
                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                    <button class="btn btn-raised btn-primary m-t-15 waves-effect" id="submitbtn"
                                        style="background-color:#eca41e !important;border:none;height:40px;width:80px;margin-left: -250px;color: black;"> Submit
                                    </button>
                                </div>
                            </form>
                        </div>
            </div>
        </div>
    </section>


    <!-- Jquery Core Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <script src="{{ asset('public/assets/js/parsley.js') }}"></script>
    <script src="{{ asset('public/assets/js/intlTelInput.js') }}"></script>
    <script src="{{ asset('public/assets/js/utils.js') }}"></script>

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

        // function changeInput() {

        //     $('#phone').intlTelInput({
        //         initialCountry: "us",
        //     });
        //     $('#phone').attr('style', 'margin-top: 10px !important');
        // }
        // function getDialCode() {
    </script>
    <script>
        $(document).ready(function() {
            var input = document.querySelector("#phone");

            window.intlTelInput(input)
            $(document).on('click', '#submitbtn', function() {
                // var phone_number = $('#phone')
                // var dial_code = window.intlTelInput(input,)
                // var dial_code = phone_number.intlTelInput('getSelectedCountryData').dialCode
                // console.log(dial_code)
                var dial_code = window.intlTelInputGlobals.getInstance(input);
                console.log(dial_code.getSelectedCountryData().dialCode);
                console.log(dial_code.getSelectedCountryData().iso2);

                $('#dial_code').val('+' + dial_code.getSelectedCountryData().dialCode)
                $('#iso').val(dial_code.getSelectedCountryData().iso2.toUpperCase())

            })
        });
    </script>



    </body>

</html>

