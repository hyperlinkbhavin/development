@extends('index')
@section('title', 'Notification View')
@section('main')
    <section class="content">

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    @if (\Session::get('success'))
                        <div class="alert alert-success alert-dismissable zoomIn animated">
                            <button aria-hidden="true" data-dismiss="alert" class="close"
                                type="button">×</button>{{ \Session::get('success') }}<a class="alert-link"
                                href="#"></a>
                        </div>
                    @endif
                    {{ \Session::forget('success') }}
                    <div class="card">
                        <div class="header">
                            <h4 class="page-title">User Broadcast</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="loader" class="lds-dual-ring hidden overlay"></div>
                                    <div class="card-box">
                                        <form id="myform" class="form-horizontal" enctype="multipart/form-data"
                                            action="{{ route('store') }}" role="form" method="POST"
                                            data-parsley-validate>
                                            @csrf
                                            <div class="body">
                                                <div class="row">

                                                    <div class="col-lg-3">
                                                        <label for="name">Select Category</label><br>

                                                        <select class="js-example-basic-single filterclass" name="name"
                                                            id="category_name" style="width: 250px">
                                                            <option value="0">All</option>
                                                            @foreach ($category as $k)
                                                                {{ $k }}
                                                                <option value="{{ $k->name }}">
                                                                    {{ $k->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <label for="name">Select Country</label><br>

                                                        <select class="js-example-basic-single filterclass"
                                                            name="country_code" id="country_code" style="width: 250px">
                                                            <option value="0">All</option>
                                                            @foreach ($code as $k)
                                                                {{ $k }}
                                                                <option value="{{ $k->country_code }}">
                                                                    {{ $k->country_code }} {{ $k->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <label for="name">Select City</label><br>

                                                        <select class="js-example-basic-single filterclass" name="city"
                                                            id="city" style="width: 250px">
                                                            <option value="0">All</option>
                                                            @foreach ($city as $k)
                                                                {{ $k }}

                                                                <option value="{{ $k->city }}">{{ $k->city }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="customer_type" value="customer">
                                            <div id="example" role="application">
                                                <div class="form-group">
                                                    <div class="col-md-10">
                                                        <select class="form-control" id="sponsor_ids" multiple="multiple"
                                                            name="users_list[]" style="width: 100%;"
                                                            data-parsley-required-message="Please select user"
                                                            data-parsley-errors-container="#error_category" required>

                                                            @foreach ($users as $k)
                                                                {{ $k }}

                                                                <option value="{{ $k->id }}">{{ $k->first_name }}
                                                                    {{ $k->last_name }}
                                                                    ({{ $k->email }})
                                                                </option>
                                                    </div>
                                                    @endforeach

                                                    </select>
                                                    <span id="error_category"></span>
                                                    <div class="demo-checkbox mt-4">
                                                        <input type="checkbox" id="basic_checkbox_8" name="allUser"
                                                            onchange="selectAllUser()">
                                                        <label for="basic_checkbox_8">Select All
                                                            User&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    </div>
                                                </div>

                                                {{-- <select class="form-control" id="sponsor_idss" multiple="multiple"
                                                name="users_list[]" style="width: 100%;" required
                                                onchange="validateUser()">

                                                @foreach ($provider as $k)
                                                {{$k}}

                                                <option value="{{$k->id}}">{{$k->first_name}} {{$k->last_name}}
                                                    ( {{$k->email}} )</option>
                                        </div>
                                        @endforeach

                                        </select>
                                        <div class="demo-checkbox mt-2">
                                            <input type="checkbox" id="basic_checkbox_88">
                                            <label for="basic_checkbox_88">Select All Provider</label>
                                        </div> --}}
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="notification_message"
                                                    placeholder="Enter broadcast message" data-parsley-required="true">
                                                <span style="color: red">
                                                    @error('notification_message')
                                                        {{ $message }}
                                                    @enderror
                                                </span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">

                                        <button class="btn btn-primary waves-effect waves-light"
                                            style="float: left;margin-left:10px;" type="submit">
                                            Send
                                        </button>
                                        <a style="margin-top: -1px;margin-left:10px" href="{{ route('dashboard') }}"
                                            class="btn btn-raised btn-primary m-t-15 waves-effect"
                                            style="background-color:#8f75d3;border:none;height:40px;width:80px">
                                            Back </a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    {{-- <div class="card">
                        <div class="header">
                            <h4 class="page-title">Customer Notification</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="loader" class="lds-dual-ring hidden overlay"></div>
                                    <div class="card-box">
                                        <form id="myform" class="form-horizontal" enctype="multipart/form-data"
                                            action="{{ route('store') }}" role="form" method="POST"
                                            data-parsley-validate>
                                            @csrf
                                            <div class="body">
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        <label for="name">Select Country</label><br>

                                                        <select class="js-example-basic-single filterclass"
                                                            name="country_code" id="country_code">
                                                            <option value="0">All</option>
                                                            @foreach ($code as $k)
                                                                {{ $k }}
                                                                <option value="{{ $k->country_code }}">
                                                                    {{ $k->country_code }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-1">
                                                        <label for="name">Select City</label><br>

                                                        <select class="js-example-basic-single filterclass" name="city"
                                                            id="city">
                                                            <option value="0">All</option>
                                                            @foreach ($city as $k)
                                                                {{ $k }}

                                                                <option value="{{ $k->city }}">{{ $k->city }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="customer_type" value="customer">
                                            <div id="example" role="application">
                                                <div class="form-group">
                                                    <div class="col-md-10">
                                                        <select class="form-control" id="sponsor_ids" multiple="multiple"
                                                            name="users_list[]" style="width: 100%;"
                                                            data-parsley-required-message="Please select user"
                                                            data-parsley-errors-container="#error_category" required>
                                                            @foreach ($users as $k)
                                                                {{ $k }}

                                                                <option value="{{ $k->id }}">{{ $k->first_name }}
                                                                    {{ $k->last_name }}
                                                                    ({{ $k->email }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span id="error_category"></span>
                                                    <div class="demo-checkbox mt-4">
                                                        <input type="checkbox" id="basic_checkbox_8" name="allUser"
                                                            onchange="selectAllUser()">
                                                        <label for="basic_checkbox_8">Select All
                                                            Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    </div>
                                                </div>


                                             
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="notification_message"
                                                    placeholder="Enter notification message" data-parsley-required="true">
                                                <span style="color: red">
                                                    @error('notification_message')
                                                        {{ $message }}
                                                    @enderror
                                                </span><br>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ">

                                        <button class="btn btn-primary waves-effect waves-light"
                                            style="float: left;margin-left:10px;" type="submit">
                                            Send
                                        </button>
                                        <a style="margin-top: -1px;margin-left:10px" href="{{ route('dashboard') }}"
                                            class="btn btn-raised btn-primary m-t-15 waves-effect"
                                            style="background-color:#8f75d3;border:none;height:40px;width:80px">
                                            Back </a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>

        </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                    <div class="card">
                        <div class="header">
                            <h4 class="page-title">Provider Broadcast </h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="loader" class="lds-dual-ring hidden overlay"></div>
                                    <div class="card-box">
                                        <form id="myform" class="form-horizontal" enctype="multipart/form-data"
                                            action="{{ route('store') }}" role="form" method="POST"
                                            data-parsley-validate>
                                            @csrf
                                            <div class="body">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="name">Select Service</label><br>

                                                        <select class="js-example-basic-single filterclass_provider"
                                                            name="service_name" id="service_provider"
                                                            style="width: 250px">
                                                            <option value="0">All</option>
                                                            @foreach ($service as $k)
                                                                {{ $k }}
                                                                <option value="{{ $k->service_name }}">
                                                                    {{ $k->service_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="name">Select Country</label><br>

                                                        <select class="js-example-basic-single " name="country_code"
                                                            id="country_code_provider" style="width: 250px">
                                                            <option value="0">All</option>
                                                            @foreach ($proviser_code as $k)
                                                                {{ $k }}
                                                                <option value="{{ $k->country_code }}">
                                                                    {{ $k->country_code }} {{ $k->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <label for="name">Select City</label><br>

                                                        <select class="js-example-basic-single filterclass_provider"
                                                            name="city" id="city_provider" style="width: 250px">
                                                            <option value="0">All</option>
                                                            @foreach ($provider_city as $k)
                                                                {{ $k }}

                                                                <option value="{{ $k->city }}">{{ $k->city }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="customer_type" value="provider">

                                                <div id="example" role="application">
                                                    <div class="form-group">
                                                        <div class="col-md-10">
                                                            @if (\Session::get('success'))
                                                                <div
                                                                    class="alert alert-success alert-dismissable zoomIn animated">
                                                                    <button aria-hidden="true" data-dismiss="alert"
                                                                        class="close"
                                                                        type="button">×</button>{{ \Session::get('success') }}<a
                                                                        class="alert-link" href="#"></a>
                                                                </div>
                                                            @endif
                                                            {{ \Session::forget('success') }}
                                                        </div>
                                                        {{-- <select class="form-control" id="sponsor_ids" multiple="multiple"
                                                    name="users_list[]" style="width: 100%;" data-parsley-min="1" `
                                                    data-parsley-min-message="This field is required"
                                                    data-parsley-errors-container="#error_category" required
                                                    onchange="validateUser()">

                                                    @foreach ($users as $a)
                                                    {{$a}}

                                                    <option value="{{$a->id}}">{{$a->first_name}} {{$a->last_name}}
                                                        ( {{$a->email}} )</option>
                                            </div>
                                            @endforeach
                                            </select>
                                            <span id="error_category"></span>

                                            <div class="demo-checkbox mt-4">
                                                <input type="checkbox" id="basic_checkbox_8">
                                                <label for="basic_checkbox_8">Select All
                                                    Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                            </div> --}}


                                                        <select style="margin-left: 20px !important; width: 1230px;"
                                                            class="form-control" id="sponsor_idss" multiple="multiple"
                                                            name="users_list[]"
                                                            data-parsley-required-message="Please select provider"
                                                            data-parsley-errors-container="#error_cat" required>
                                                            @foreach ($provider as $k)
                                                                {{ $k }}

                                                                <option value="{{ $k->id }}">{{ $k->first_name }}
                                                                    {{ $k->last_name }}
                                                                    ({{ $k->email }})
                                                                </option>
                                                    </div>
                                                    @endforeach

                                                    </select>
                                                    <span id="error_cat"></span>

                                                    <div class="demo-checkbox mt-4">
                                                        <input type="checkbox" id="basic_checkbox_88" name="allUser"
                                                            onchange="selectAllProvider()">
                                                        <label for="basic_checkbox_88">Select All
                                                            Provider&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="notification_message"
                                                    placeholder="Enter broadcast message" data-parsley-required="true"
                                                    style="margin-top:-18px">
                                                <span style="color: red">
                                                    @error('notification_message')
                                                        {{ $message }}
                                                    @enderror
                                                </span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">

                                        <button class="btn btn-primary waves-effect waves-light"
                                            style="float: left;margin-left:10px;" type="submit">
                                            Send

                                        </button>

                                        <a style="margin-top: -1px;margin-left:10px" href="{{ route('dashboard') }}"
                                            class="btn btn-raised btn-primary m-t-15 waves-effect"
                                            style="background-color:#8f75d3;border:none;height:40px;width:80px">
                                            Back </a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>

        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                    <div class="card">
                        <div class="header">
                            <h2> SENT BROADCAST USER LIST </h2>

                        </div>

                        {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" class="form-control" id="from_date" name="from_date">
                            </div>
                        </div>
                    </div> --}}
                        <div class="body">
                            <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')"
                            style="margin-left: 96px;
                            padding-right: 13px;">Excel</button>
                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            {{-- </div> --}}
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>Full Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Sent DateTime</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                               
                                <tbody>

                            </table>


                            <table style="display: none" id="notification">
                                <thead>
                                    <tr>


                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Sent DateTime</th>

                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata->id }}</td>
                                            <td>{{ $udata->full_name }}</td>
                                            <td>{{ $udata->title }}</td>

                                            <td>{{ $udata->message }}</td>

                                            <td>{{ $udata->insert_datetime }}</td>



                                        </tr>
                                    @endforeach
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                    <div class="card">
                        <div class="header">
                            <h2> SENT BROADCAST PROVIDER LIST </h2>

                        </div>

                        {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" class="form-control" id="from_date" name="from_date">
                            </div>
                        </div>
                    </div> --}}
                        <div class="body">
                            <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')"
                            style="margin-left: 96px;
                            padding-right: 13px;">Excel</button>
                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            {{-- </div> --}}
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable-provider">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>Full Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Sent DateTime</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                               
                                <tbody>

                            </table>


                            <table style="display: none" id="notification">
                                <thead>
                                    <tr>


                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Sent DateTime</th>

                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata->id }}</td>
                                            <td>{{ $udata->full_name }}</td>
                                            <td>{{ $udata->title }}</td>

                                            <td>{{ $udata->message }}</td>

                                            <td>{{ $udata->insert_datetime }}</td>



                                        </tr>
                                    @endforeach
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <script src="{{ asset('public/assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('public/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

    <script src="{{ asset('public/assets/bundles/mainscripts.bundle.js') }}"></script><!-- Custom Js -->
    {{-- <script src="{{asset('public/assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table_data = [
            // {
            //     data: 'id',
            //     name: 'id',
            //     type: 'num'
            // },
            {
                data: 'full_name',
                name: 'full_name'
            },
           
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'message',
                name: 'message',
            },
            {
                data: 'insert_datetime',
                name: 'insert_datetime',
            },
            {
                data: 'action',
                name: 'action',
            },
        ];


        // alert(table_data)
        // console.log(table_data);

        var table = $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'print',
                exportOptions: {
                    stripHtml: false
                },

            }],
            serverSide: true,
            processing: true,
            "responsive": true,
            "lengthChange": false,
            "iDisplayLength": 20,

            ajax: {
                type: "POST",
                url: "{{ route('get_notification') }}",
                data: function(d) {
                    d.user_name = $('select[name=user_name]').val();
                }
                // dataType: "json",
            },
            columns: table_data,
            order: [
                [3, 'desc']
            ],
            // success : function(data){
            //     alert('hello');
            // }
        });

        function validateUser() {
            //    alert(this.val)
            var cus_id = document.getElementById("sponsor_ids").selectedOptions.length
            //    console.log(cus_id)
            var pro_id = document.getElementById("sponsor_idss").selectedOptions.length
            if (cus_id > 0) {
                // alert('1')
                // var x = document.getElementById("myCheck").required;
                document.getElementById("#sponsor_idss").required = false;

            }
            if (cus_id == 0) {
                // alert('2')

                document.getElementById("sponsor_idss").required = true;

            }
            if (pro_id > 0) {
                // alert('3')
                document.getElementById("sponsor_ids").required = false;

            }
            if (pro_id == 0) {
                // alert('4')

                document.getElementById("sponsor_ids").required = true;

            }
            //    console.log(id.length)
        }

        function html_table_to_excel(type) {
            // var today = new Date();

            var data = document.getElementById('notification');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'notification_' + 'list' + '.' + type)
        }

        function imprimir() {
            var divToPrint = document.getElementById("notification");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }

        function selectAllProvider() {
            var is_select = document.getElementById('basic_checkbox_88')
            if (is_select.checked) {
                document.getElementById('sponsor_idss').removeAttribute('required')
                document.getElementById('sponsor_idss').setAttribute('disabled', 'true')

            } else {
                document.getElementById('sponsor_idss').setAttribute('required', 'true')
                document.getElementById('sponsor_idss').removeAttribute('disabled')

            }
        }

        function selectAllUser() {
            var is_select = document.getElementById('basic_checkbox_8')
            if (is_select.checked) {
                document.getElementById('sponsor_ids').removeAttribute('required')
                document.getElementById('sponsor_ids').setAttribute('disabled', 'true')
            } else {
                document.getElementById('sponsor_ids').setAttribute('required', 'true')
                document.getElementById('sponsor_ids').removeAttribute('disabled')


            }
        }

        $(document).ready(function() {


            $('.filterclass').on('change', function() {
                // alert('hhhe')
                var category = $('#category_name')

                var value = $('#country_code')
                // alert(value);
                // $("#city").html('');

                var city = $('#city')

                var data = {

                    'name': category.val(),
                    'country_code': value.val(),
                    'city': city.val()
                }
                // alert(category.val())
                console.log(data)
                $.ajax({
                    url: "{{ route('get_data') }}",
                    type: "post",
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        //    console.log(response.city)
                        $('#city').html('<option value="0" selected>All</option>');
                        $.each(response.city, function(key, value) {

                            if (data.city == value.city) {
                                console.log(value.city)
                                $("#city").append('<option value="' + value
                                    .city + '" selected>' + value.city + '</option>'
                                );

                            } else {

                                $("#city").append('<option value="' + value
                                    .city + '" >' + value.city + '</option>');
                            }
                        });

                        $('#sponsor_ids').empty()
                        $.each(response.user, function(key, value) {
                            $('#sponsor_ids').append('<option value="' + value.id +
                                '">' + value.first_name + ' ' + ' ' + value
                                .last_name + ' (' + value.email + ')' +
                                '</option>');
                        })

                    }
                })
            })
        })

        $(document).ready(function() {


            $('#country_code').on('change', function() {
                // alert('hhhe')
                var value = $('#country_code')
                // alert(value);
                // $("#city").html('');

                var city = $('#city')

                var data = {
                    'country_code': value.val(),
                    'city': '0'
                }
                // alert(city.val())
                city.val('0')
                // console.log(data)
                $.ajax({
                    url: "{{ route('get_data') }}",
                    type: "post",
                    data: data,
                    dataType: 'json',
                    success: function(response) {

                        // console.log(response)
                        // console.log(response[0].city);
                        $('#city').html('<option value="0" selected>All</option>');
                        $.each(response.city, function(key, value) {

                            console.log(value.city)
                            $("#city").append('<option value="' + value
                                .city + '" >' + value.city + '</option>');
                        });

                        $('#sponsor_ids').empty()
                        $.each(response.user, function(key, value) {
                            $('#sponsor_ids').append('<option value="' + value.id +
                                '">' + value.first_name + ' ' + ' ' + value
                                .last_name + ' (' + value.email + ')' +
                                '</option>');
                        })

                    }
                })
            })
        })

        $(document).ready(function() {

            // function changeUser(value) {
            // alert(value.value)
            $('.filterclass_provider').on('change', function() {
                // alert('dds')
                var service = $('#service_provider')
                var value = $('#country_code_provider')
                // $("#city_provider    ").html('');
                // alert(service.val()) 
                var city = $('#city_provider')
                var a = {
                    'service_name': service.val(),
                    'country_code': value.val(),
                    'city': city.val()
                }

                console.log(a)
                $.ajax({
                    url: "{{ route('get_provider_data') }}",
                    type: "post",
                    data: a,
                    dataType: 'json',
                    success: function(response) {

                        $('#city_provider').html('<option value="0">All</option>');
                        $.each(response.city, function(key, value) {

                            if (a.city == value.city) {

                                $("#city_provider").append('<option value="' + value
                                    .city + '" selected>' + value.city +
                                    '</option>');

                            } else {

                                $("#city_provider").append('<option value="' + value
                                    .city + '">' + value.city + '</option>');
                            }

                        });

                        $('#sponsor_idss').empty()
                        $.each(response.user, function(key, value) {
                            $('#sponsor_idss').append('<option value="' + value.id +
                                '">' + value.first_name + ' ' + ' ' + value
                                .last_name + ' (' + value.email + ')' +
                                '</option>');
                        })

                    }
                })
            })
        })

        $(document).ready(function() {

            // function changeUser(value) {
            // alert(value.value)
            $('#country_code_provider').on('change', function() {
                // alert('dds')
                var service = $('#service_provider')
                var value = $('#country_code_provider')
                // $("#city_provider    ").html('');
                // alert(service.val()) 
                var city = $('#city_provider')
                var a = {
                    'service_name': service.val(),
                    'country_code': value.val(),
                    'city': '0'
                }
                city.val('0')

                $.ajax({
                    url: "{{ route('get_provider_data') }}",
                    type: "post",
                    data: a,
                    dataType: 'json',
                    success: function(response) {

                        $('#city_provider').html('<option value="0" selected>All</option>');
                        $.each(response.city, function(key, value) {

                            console.log(value.city)
                            $("#city_provider").append('<option value="' + value
                                .city + '" >' + value.city + '</option>');
                        });

                        $('#sponsor_idss').empty()
                        $.each(response.user, function(key, value) {
                            $('#sponsor_idss').append('<option value="' + value.id +
                                '">' + value.first_name + ' ' + ' ' + value
                                .last_name + ' (' + value.email + ')' +
                                '</option>');
                        })

                    }
                })
            })
        })

    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table_data1 = [
            // {
            //     data: 'id',
            //     name: 'id',
            //     type: 'num'
            // },
            {
                data: 'full_name',
                name: 'full_name'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'message',
                name: 'message',
            },
            {
                data: 'insert_datetime',
                name: 'insert_datetime',
            },
            {
                data: 'action',
                name: 'action',
            },
        ];


        // alert(table_data)
        // console.log(table_data);

        var table1 = $('.js-exportable-provider').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'print',
                exportOptions: {
                    stripHtml: false
                },

            }],
            serverSide: true,
            processing: true,
            "responsive": true,
            "lengthChange": false,
            "iDisplayLength": 20,

            ajax: {
                type: "POST",
                url: "{{ route('get_provider_notification') }}",
                data: function(d) {
                    d.user_name = $('select[name=user_name]').val();
                }
                // dataType: "json",
            },
            columns: table_data1,
            order: [
                [3, 'desc']
            ],
            // success : function(data){
            //     alert('hello');
            // }
        });
    </script>

@endsection
