{{-- @inject('commmon', 'App\Helpers\common') --}}

<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>Bawabat Admin Panel</title>
    <!-- Favicon-->

    <link rel="icon" href="favicon.ico" type="image/x-icon">

   
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/morrisjs/morris.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/summernote/summernote-bs2.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/cropper.css') }}">
    <script type="text/javascript" src="{{ asset('public/assets/js/cropper.js') }}"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

    <link href="{{ asset('public/assets/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('public/assets/css/color_skins.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.css"
        integrity="sha512-JzSVRb7c802/njMbV97pjo1wuJAE/6v9CvthGTDxiaZij/TFpPQmQPTcdXyUVucsvLtJBT6YwRb5LhVxX3pQHQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <!-- Chat Css -->
    <style>
        /* body {
            background: #f6d352;
        }

        h1 {
            font-weight: bold;
            font-size: 23px;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            text-align: center;
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        input {
            margin-top: 40px;
        }

        .section {
            margin-top: 150px;
            background: #fff;
            padding: 50px 30px;
        }

        .modal-lg {
            max-width: 1000px !important;
        } */
        .modal .nav {
            display: flex;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
            justify-content: center;
        }
        .label.label-app {
            background-color: #ccc;
            float: right;
            color: #555;
            border-radius: 5px;
            font-weight: bold;
            font-size: 12px !important;
        }

        /* .dataTables_wrapper .dt-buttons a.dt-button {
            margin-right: -47px;
            margin-left: 89px;
            width: 11px;
            height: 91px;
            background-color: white;
            color: black;
            padding: 10px 25px;
        }
        .btn-secondary {

            margin-bottom: -38px;
            margin-left: 17px;
        } */
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before {
            opacity: 1 !important;
        }

        .dt-buttons.btn-group {
            position: absolute;
            top: -48px;
            left: 15px;
        }

        .three-btn {
            right: -84px;
        }
     
    </style>
    @yield('head_content')

</head>


<body class="theme-orange">
    <!-- Page Loader -->


    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <p>Please wait...</p>
            {{-- <div class="m-t-30"><img src="{{ asset('public/assets/images/logo1.png') }}" width="48" height="48" alt="Bawabat"></div> --}}
        </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div><!-- Search  -->
    <div class="search-bar">
        <div class="search-icon"> <i class="material-icons">search</i> </div>
        <input type="text" placeholder="Explore Bawabat...">
        <div class="close-search"> <i class="material-icons">close</i> </div>
    </div>
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="col-12">

            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ route('dashboard') }}">Bawabat</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a onclick="logout()" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a></li>
            </ul>
        </div>
    </nav>

    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">

            <div class="info-container">
                <div class="name" data-toggle="dropdown">{{ auth()->guard('admin')->user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                        role="button" style="margin-top: 3px; margin-right: -26px;"> keyboard_arrow_down </i>
                    <ul class="dropdown-menu slideUp" style="margin-right: -36px;">

                        <li><a href="{{ route('profile') }}"><i class="material-icons">person</i>Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('change_password') }}"><i class="material-icons">lock</i>Password</a>
                        </li>

                        @if (App\Helpers\common::has_permissions('admin.view_coins'))
                            <li class="divider"></li>
                            <li><a href="{{ route('view_coins') }}"><i class="material-icons">attach_money</i>Coins</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="btn-group user-helper-dropdown">
                    <ul class="dropdown-menu slideUp">

                        <li><a onclick="logout()"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
                {{-- <div class="email">{{session('user')[0]['email']}}</div> --}}
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->

        <div class="menu">

            <ul class="list">
                {{-- -- <li class="header">MAIN NAVIGATION</li> --}}

                <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
                    <a class="nav-link " aria-current="page" href="{{ route('dashboard') }}"><i
                            class="zmdi zmdi-home mr-3"></i>Dashboard</a>
                <li>
                    {{--                 
                <li class="{{ Request::segment(2) === 'customers' ? 'active' : null }} {{ Request::segment(2) === 'view_user_data' ? 'active' : null }} "> 
                    <a  class="nav-link " aria-current="page" href="{{route('customers')}}"><i class="zmdi zmdi-accounts-alt mr-3"></i><span> Manage Customers</span> <span id="user_counts" class="label label-app pull-right">{{ App\Models\Tbl_user::where('role','customer')->get()->count();}}</span></a>
                <li> --}}

                    @if (App\Helpers\common::has_permissions('admin.customers'))
                <li
                    class="{{ Request::segment(2) === 'customers' ? 'active' : null }} {{ Request::segment(2) === 'view_user_data' ? 'active' : null }} {{ Request::segment(2) === 'customer_edit' ? 'active' : null }} ">
                    <a class="nav-link " aria-current="page" href="{{ route('customers') }}"><i
                            class="zmdi zmdi-assignment-account mr-3"></i>Manage Users <span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\Tbl_user::where('role', 'customer')->get()->count() }}</a>
                <li>
                    @endif

                    @if (App\Helpers\common::has_permissions('admin.service_provider'))
                <li
                    class="{{ Request::segment(2) === 'service_provider' ? 'active' : null }} {{ Request::segment(2) === 'view_provider_data' ? 'active' : null }} {{ Request::segment(2) === 'provider_time' ? 'active' : null }} {{ Request::segment(2) === 'provider_images' ? 'active' : null }} {{ Request::segment(2) === 'provider_edit' ? 'active' : null }}{{ Request::segment(2) === 'business_edit' ? 'active' : null }}  ">
                    <a class="nav-link " aria-current="page" href="{{ route('service_provider') }}"><i
                            class="zmdi zmdi-accounts-alt mr-3"></i> Manage Providers <span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\Tbl_user::where('role', 'provider')->get()->count() }}</a>
                <li>
                    @endif

                    @if (App\Helpers\common::has_permissions('admin.service_list'))
                <li class="{{ Request::segment(2) === 'service_list' ? 'active' : null }}   ">
                    <a class="nav-link " aria-current="page" href="{{ route('service_list') }}"><i
                            class="zmdi zmdi-view-headline mr-3"></i>All Service <span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\Services::where('is_delete', '0')->get()->count() }}</a>
                <li>
                    @endif

                    @if (App\Helpers\common::has_permissions('admin.service_categories'))
                <li
                    class="{{ Request::segment(2) === 'service_categories' ? 'active' : null }} {{ Request::segment(2) === 'view_categories_data' ? 'active' : null }} {{ Request::segment(2) === 'categories_edit' ? 'active' : null }} {{ Request::segment(2) === 'add_cat' ? 'active' : null }}">
                    <a class="nav-link " aria-current="page" href="{{ route('service_categories') }}">
                        {{-- <i class="zmdi zmdi-format-list-bulleted mr-3"></i>  --}}
                        <i class="zmdi zmdi-storage mr-3"></i>

                        Service Categories <span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\serviceCategory::where('is_delete', '0')->get()->count() }}</a>
                <li>
                    @endif
                    @if (App\Helpers\common::has_permissions('admin.service_subcategories'))
                <li
                    class="{{ Request::segment(2) === 'service_subcategories' ? 'active' : null }}{{ Request::segment(2) === 'add_subcat' ? 'active' : null }} {{ Request::segment(2) === 'subcategories_edit' ? 'active' : null }} {{ Request::segment(2) === 'view_subcategories_data' ? 'active' : null }}">
                    <a class="nav-link " aria-current="page" href="{{ route('service_subcategories') }}">
                        {{-- <i class="zmdi zmdi-accounts-alt mr-3"></i>  --}}
                        <i class="zmdi zmdi-format-list-bulleted mr-3"></i>
                        Service SubCategories <span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\subcategory::where('is_delete', '0')->get(['name'])->count() }}</a>
                <li>
                    @endif
                    @if (App\Helpers\common::has_permissions('admin.manage_chat'))
                <li
                    class="{{ Request::segment(2) === 'manage_chat' ? 'active' : null }}{{ Request::segment(2) === 'chat_view' ? 'active' : null }} ">
                    <a class="nav-link " aria-current="page" href="{{ route('manage_chat') }}">
                        <i class="zmdi zmdi-whatsapp mr-3"></i>
                        {{-- <i class="zmdi zmdi-comment-text-alt"></i> --}}
                        Manage Chat<span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\ChatRoom::where('user_id1', '!=', '0')->where('user_id2', '!=', '0')->where('is_active', '1')->get()->count() }}</a>
                <li>
                    @endif
                    @if (App\Helpers\common::has_permissions('admin.advertisement_list'))
                <li
                    class="{{ Request::segment(2) === 'advertisement_list' ? 'active' : null }} {{ Request::segment(2) === 'advertisement_edit' ? 'active' : null }} {{ Request::segment(2) === 'add_advertisements' ? 'active' : null }} {{ Request::segment(2) === 'view_advertisements_data' ? 'active' : null }}">
                    <a class="nav-link " aria-current="page" href="{{ route('advertisement_list') }}"><i
                            class="zmdi zmdi-tv-alt-play mr-3"></i>
                        Home Advertisement Banners <span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\Reel::where('is_delete', '0')->get()->count() }}</a>
                <li>
                    @endif
                    @if (App\Helpers\common::has_permissions('admin.reel_list'))
                <li
                    class="{{ Request::segment(2) === 'reel_list' ? 'active' : null }} {{ Request::segment(2) === 'view_reel' ? 'active' : null }} ">
                    <a class="nav-link " aria-current="page" href="{{ route('reel_list') }}"><i
                            class="zmdi zmdi-play-circle-outline mr-3"></i>
                        Manage Story <span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\StoryReel::where('is_delete', '0')->get()->count() }}</a>
                <li>
                    @endif
                    @if (App\Helpers\common::has_permissions('admin.view_notification'))
                <li
                    class="{{ Request::segment(2) === 'view_notification' ? 'active' : null }} {{ Request::segment(2) === 'view_customer_notification' ? 'active' : null }}{{ Request::segment(2) === 'view_provider_notification' ? 'active' : null }}">
                    <a class="nav-link " aria-current="page" href="{{ route('view_notification') }}"><i
                            class="zmdi zmdi-notifications mr-3"></i>
                        Broadcast</a>
                <li>
                    @endif
                    @if (App\Helpers\common::has_permissions('admin.view_admin_list'))
                <li
                    class="{{ Request::segment(2) === 'view_admin_list' ? 'active' : null }}{{ Request::segment(2) === 'permissions' ? 'active' : null }}{{ Request::segment(2) === 'view_page' ? 'active' : null }}  ">
                    <a class="nav-link " aria-current="page" href="{{ route('view_admin_list') }}"><i
                            class="zmdi zmdi-accounts-add mr-3"></i>
                        Manage SubAdmin <span id="user_counts"
                            class="label label-app pull-right">{{ App\Models\Admin::where('role', 'A')->where('is_delete', '0')->get()->count() }}</a>
                <li>
                    @endif
                <li class="header" style="font-size: 14px;">Page Controls</li>

                @if (App\Helpers\common::has_permissions('admin.contactus'))
                    <li
                        class="{{ Request::segment(2) === 'contactus' ? 'active' : null }} {{ Request::segment(2) === 'contactusview' ? 'active' : null }}">
                        <a class="nav-link " aria-current="page" href="{{ route('contactus') }}"><i
                                class="zmdi zmdi-phone mr-3"></i>Contact Us</a>
                    <li>
                @endif
                @if (App\Helpers\common::has_permissions('admin.aboutus'))
                    <li class="{{ Request::segment(2) === 'aboutus' ? 'active' : null }}">
                        <a class="nav-link " aria-current="page" href="{{ route('aboutus') }}"><i
                                class="zmdi zmdi-assignment mr-3"></i>About Us</a>
                    <li>
                @endif
                @if (App\Helpers\common::has_permissions('admin.terms_and_condition'))
                    <li class="{{ Request::segment(2) === 'terms_and_condition' ? 'active' : null }}">
                        <a class="nav-link " aria-current="page" href="{{ route('terms_and_condition') }}"><i
                                class="zmdi zmdi-assignment mr-3"></i>Terms & Conditions</a>
                    <li>
                @endif
                @if (App\Helpers\common::has_permissions('admin.privacy_policy'))
                    <li class="{{ Request::segment(2) === 'privacy_policy' ? 'active' : null }}">
                        <a class="nav-link " aria-current="page" href="{{ route('privacy_policy') }}"><i
                                class="zmdi zmdi-assignment mr-3"></i>Privacy Policy</a>
                    <li>
                @endif
                @if (App\Helpers\common::has_permissions('admin.faqlist'))
                    <li
                        class="{{ Request::segment(2) === 'faqlist' ? 'active' : null }} {{ Request::segment(2) === 'edit_faq' ? 'active' : null }} {{ Request::segment(2) === 'add_faq' ? 'active' : null }}  {{ Request::segment(2) === 'faq_view' ? 'active' : null }}">
                        <a class="nav-link " aria-current="page" href="{{ route('faqlist') }}"><i
                                class="zmdi zmdi-assignment mr-3"></i>FAQ’s</a>
                    <li>
                @endif

                {{-- </ul> --}}

            </ul>
        </div>
    </aside>


    @yield('main')



    <!-- Main Content -->
    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <!-- Jquery Core Js -->
    <script src="{{ asset('public/assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('public/assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/bundles/mainscripts.bundle.js') }}"></script>

    {{-- <script src="{{asset('public/assets/plugins/jquery/jquery.js')}}"></script> --}}
    {{-- <script src="{{asset('public/assets/plugins/jquery/jquery-v3.2.1.min.js')}}"></script> --}}

    <script src="{{ asset('public/assets/js/parsley.js') }}"></script>
    <script src="{{ asset('public/assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('public/assets/bundles/morrisscripts.bundle.js') }}"></script><!-- Morris Plugin Js -->
    <script src="{{ asset('public/assets/bundles/sparkline.bundle.js') }}"></script> <!-- Sparkline Plugin Js -->
    <script src="{{ asset('public/assets/bundles/knob.bundle.js') }}"></script> <!-- Jquery Knob Plugin Js -->

    <script src="{{ asset('public/assets/js/pages/index.js') }}"></script>
    <script src="{{ asset('public/assets/js/pages/charts/jquery-knob.min.js') }}"></script>
    {{-- <script src="{{asset('public/assets/plugins/summernote/summernote-bs4.min.js')}}"></script> --}}
    <script src="{{ asset('public/assets/plugins/ckeditor/ckeditor.js') }}"></script> <!-- Ckeditor -->
    <script src="{{ asset('public/assets/js/pages/forms/editors.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/momentjs/moment.js') }}"></script> <!-- Moment Plugin Js -->

    <script src="{{ asset('public/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
    </script>

    <script src="{{ asset('public/assets/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    {{-- <script src="{{asset('public/assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.js"
        integrity="sha512-HSX6+785OA1Th/CvDy4O2giA2Bvr0Ex6M5yeh+PMomOnpDKBeEnTurP5sSO+jlHShGXku8UmG93POKvXYf3zEg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/assets/js/xlsx.full.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</body>

</html>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $(document).ready(function() {
    $('select').select2();
    // });
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
    });


    // $(document).ready(function() {
    //     $("#checkAll").click(function() {
    //         $(".cb-element").prop("checked", this.checked);
    //     });

    //     $('.cb-element').click(function() {
    //         if ($('.cb-element:checked').length == $('.cb-element').length) {
    //         $('#checkAll').prop('checked', true);
    //         } else {
    //         $('#checkAll').prop('checked', false);
    //         }
    // });
    // });

    //  $("#basic_checkbox_8").click(function(){
    //     if($("#basic_checkbox_8").is(':checked') ){ //select all
    //       $("#sponsor_ids").find('option').prop("selected",true);
    //     //   $("#sponsor_ids").toggle();

    //       $("#sponsor_ids").trigger('change');
    //     } else { //deselect all
    //       $("#sponsor_ids").find('option').prop("selected",false);
    //       $("#sponsor_ids").trigger('change');
    //     }
    //  });

    //  $("#basic_checkbox_88").click(function(){
    //     if($("#basic_checkbox_88").is(':checked') ){ //select all
    //       $("#sponsor_idss").find('option').prop("selected",true);
    //       $("#sponsor_idss").trigger('change');
    //     } else { //deselect all
    //       $("#sponsor_idss").find('option').prop("selected",false);
    //       $("#sponsor_idss").trigger('change');
    //     }
    //  });

    function logout() {
        var redirect = "{{ route('adminLogin') }}"
        Swal.fire({
            title: 'Are you sure you want to logout?',
            //    showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            //    denyButtonText: `Don't logout`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {


                $.ajax({
                    url: "{{ route('Logout') }}",
                    type: "get",
                    success: function(response) {
                        //   $("#success_message").text(response.message);
                        // alert(response)
                        window.location = redirect
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }
</script>
