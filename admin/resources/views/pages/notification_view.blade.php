@extends('index')
@section('title', 'Notification View')
@section('main')
    <section class="content">



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
                            {{-- <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')"
                            style="margin-left: 96px;
                            padding-right: 13px;">Excel</button> --}}
                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            {{-- </div> --}}
                            <input type="hidden" value="{{ $data['insert_datetime'] }}" id="insert_datetime">
                            <input type="hidden" value="{{ $data['message'] }}" id="message">

                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>Full Name</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Sent DateTime</th>
                                        {{-- <th>Action</th> --}}

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

                                    {{-- @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata->id }}</td>
                                            <td>{{ $udata->full_name }}</td>
                                            <td>{{ $udata->title }}</td>

                                            <td>{{ $udata->message }}</td>

                                            <td>{{ $udata->insert_datetime }}</td>



                                        </tr>
                                    @endforeach --}}
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
            }
       
        ];


        // alert(table_data)
        // console.log(table_data);

        var table = $('.js-exportable').DataTable({
            // dom: 'Bfrtip',
            // buttons: [{
            //     extend: 'print',
            //     exportOptions: {
            //         stripHtml: false
            //     },

            // }],
            serverSide: true,
            processing: true,
            "responsive": true,
            "lengthChange": false,
            "iDisplayLength": 20,

            ajax: {
                type: "POST",
                url: "{{ route('customer_notification_table') }}",
                data: function(d) {
                    d.insert_datetime = $('#insert_datetime').val();
                    d.message = $('#message').val();
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
    </script>

@endsection
