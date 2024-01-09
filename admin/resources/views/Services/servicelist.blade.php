@extends('index')
@section('title', 'Manage Customers')
@section('main')

    <section class="content">
        <div class="block-header">
            <div class="row">

            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">

            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">


                    <div class="card">
                        <div class="header">
                            <h2> Services LIST </h2>

                        </div>


                        <div class="body">

                            <div class="row">
                                <div class="col-lg-2 ml-3">
                                    <label for="start_date">Start Duration</label>
                                    {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"> --}}
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?php date_default_timezone_set('Asia/Kolkata'); ?>
                                            <input type="date" name="start_date" class="form-control" id="start_date"
                                                required="">
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-lg-2">
                                    <label for="start_date">End Duration</label>
                                    {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"> --}}
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?php date_default_timezone_set('Asia/Kolkata'); ?>
                                            <input type="date" name="start_date" class="form-control" id="end_date"
                                                required="">
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>


                            <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')"
                                style="margin-left: 96px;
                            padding-right: 13px;">Excel</button>
                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            @if (\Session::get('success'))
                                <div class="alert alert-success alert-dismissable zoomIn animated col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-2"
                                    style="margin-left: 1105px;" id="message">
                                    <button aria-hidden="true" data-dismiss="alert" class="close"
                                        type="button">×</button>{{ \Session::get('success') }}<a class="alert-link"
                                        href="#"></a>
                                </div>
                            @endif
                            <table id="customer_listt"
                                class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>


                                        <th>Id</th>
                                        <th>Provider name</th>
                                        <th>Service name</th>
                                        <th>Category name</th>
                                        <th>Sub-category name</th>
                                        <th>Description</th>
                                        <th>Minimum Rate</th>
                                        <th>Maximum Rate</th>
                                        <th>Average Rating</th>
                                        <th>Created Date</th>
                                        <th>Service Time</th>
                                        <th>Service Images</th>
                                        <th>Service Reviews</th>

                                    </tr>
                                </thead>

                                <tbody>

                            </table>
                            <table style="display: none" id="service_list">
                                <thead>
                                    <tr>


                                        <th>Id</th>
                                        <th>Service name</th>
                                        <th>Category name</th>
                                        <th>Sub-category name</th>
                                        <th>Description</th>
                                        <th>Minimum Rate</th>
                                        <th>Maximum Rate</th>
                                        <th>Average Rating</th>
                                        <th>Created Date</th>

                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata['id'] }}</td>
                                            <td>{{ $udata['service_name'] }}</td>
                                            <td>{{ $udata['name'] }}</td>
                                            <td>{{ $udata['subcat_name'] }} </td>
                                            <td>{{ $udata['description'] }}</td>
                                            <td>{{ $udata['minimum_rate'] }} </td>
                                            <td>{{ $udata['maximum_rate'] }} </td>
                                            <td>{{ $udata['total_avg_rating'] }} </td>
                                            <td>{{ $udata['insert_date'] }}</td>

                                            {{-- <td>{{$udata['img']}}</td> --}}
                                            {{-- <td> <img src="{{ asset('/resources/images/' . $udata->img)  }}" height="100px" width="100px"/> </td>
                              <td><a href={{url('userview/'.base64_encode($udata['id']))}} class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>
                                  <a href={{url('view/'.base64_encode($udata['id']))}} class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>
                                  <a href={{url('delete/'.base64_encode($udata['id']))}} class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a></td> --}}
                                        </tr>
                                    @endforeach
                            </table>
                            </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script><!-- Custom Js -->
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.js"
        integrity="sha512-HSX6+785OA1Th/CvDy4O2giA2Bvr0Ex6M5yeh+PMomOnpDKBeEnTurP5sSO+jlHShGXku8UmG93POKvXYf3zEg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>




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
                data: 'provider_name',
                name: 'provider_name',
            },
            {
                data: 'service_name',
                name: 'service_name',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'subcat_name',
                name: 'subcat_name',
            },
            {
                data: 'description',
                name: 'description',
                render: function(data, type, full, meta) {
                    if (type === 'display' && data.length > 50) {
                        // Truncate the text and append dots
                        data = data.substr(0, 100) + '...';
                    }
                    return data;
                }
            },

            {
                data: 'minimum_rate',
                name: 'minimum_rate',
                // orderable: false,
                // searchable: false,
            },
            {
                data: 'maximum_rate',
                name: 'maximum_rate'
            },
            {
                data: 'total_avg_rating',
                name: 'total_avg_rating',
            },
            {
                data: 'insert_date',
                name: 'insert_date',

            },
            {
                data: 'time',
                name: 'time',
                // orderable: false,
                // searchable: false,
            },
            {
                data: 'images',
                name: 'images',
                // orderable: false,
                // searchable: false,
            },
            {
                data: 'reviews',
                name: 'reviews',
                // orderable: false,
                // searchable: false,
            },
        ];

        function set_image(image) {
            if (image && image != '') {

                return `<video width="150" height="100"  controls>
    <source src="${image}" type="video/mp4"></video>`;

                // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
            } else {
                return "-N/A-";
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function set_image(image) {
            if (image && image != '') {

                return `<img width="100" height="80" src="${image}"></img>`;
                // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${img_url}${image}"><img src="${img_url}${image}"  width="80" height="80"></a></div>`;

                // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
            } else {
                return "-N/A-";
            }
        }
        // alert(table_data)
        // console.log(table_data);
        $('#start_date,#end_date').change(function() {
            table.draw();
        });

        var table = $('.js-exportable').DataTable({
            // dom: 'Bfrtip',
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
            "lengthChange": true,
            "bPaginate": true,
            "iDisplayLength": 20,
            ajax: {
                type: "Post",
                url: "{{ route('date_filter') }}",
                dataType: "json",
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: table_data,

            order: [
                [0, 'desc']
            ]
        });




        function html_table_to_excel(type) {
            // var today = new Date();

            var data = document.getElementById('service_list');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'service_' + 'list' + '.' + type)
        }


        function imprimir() {
            var divToPrint = document.getElementById("customer_listt");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.16.0/dist/pdf-lib.js"></script> --}}
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    </body>

    </html>
@endsection
