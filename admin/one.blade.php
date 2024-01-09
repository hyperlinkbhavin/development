

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
                            <h4 class="page-title">Customer Notification</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="loader" class="lds-dual-ring hidden overlay"></div>
                                    <div class="card-box">
                                        <form id="myform" class="form-horizontal" enctype="multipart/form-data"
                                            action="{{ route('store') }}" role="form" method="POST"
                                            data-parsley-validate>
                                            @csrf
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
                                                            Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
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
                            <h4 class="page-title">Provider Notification </h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="loader" class="lds-dual-ring hidden overlay"></div>
                                    <div class="card-box">
                                        <form id="myform" class="form-horizontal" enctype="multipart/form-data"
                                            action="{{ route('store') }}" role="form" method="POST"
                                            data-parsley-validate>
                                            @csrf
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
                            <h2> SENT NOTIFICATION LIST </h2>

                        </div>

                        {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" class="form-control" id="from_date" name="from_date">
                            </div>
                        </div>
                    </div> --}}
                        <div class="body">
                            <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')" style="margin-left: 16px;
                            padding-right: 13px;">Excel</button>
                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            {{-- </div> --}}
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Sent DateTime</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Sent DateTime</th>

                                    </tr>
                                </tfoot>
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


    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script><!-- Custom Js -->
    {{-- <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table_data = [{
                data: 'id',
                name: 'id',
                type: 'num'
            },
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
        ];


        // alert(table_data)
        // console.log(table_data);

        var table = $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'print',
                exportOptions: {stripHtml: false },
               
            }
        ],
            serverSide: true,
            processing: true,
            "responsive": true,
            "lengthChange": false,
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
                [0, 'desc']
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
    </script>

@endsection