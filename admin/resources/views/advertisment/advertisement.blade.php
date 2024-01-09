<style>
    .dt-buttons.btn-group {
        position: absolute;
        top: -48px;
        left: 85px !important;

        /* th.js-exportable {
            width: 20px !important;
        } */
    }
</style>

@extends('index')
@section('title', 'Manage Service Provider')
@section('main')

    <section class="content">
        <div class="block-header">
            <div class="row">


            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>HOME ADVERTISEMENT BANNERS</h2>

                        </div>
                        <div class="body">
                            @if (\Session::get('success'))
                                <div class="alert alert-success alert-dismissable zoomIn animated col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-2"
                                    style="margin-left: 1105px;" id="message">
                                    <button aria-hidden="true" data-dismiss="alert" class="close"
                                        type="button">×</button>{{ \Session::get('success') }}<a class="alert-link"
                                        href="#"></a>
                                </div>
                            @endif
                            <a style="color:black !important;" href="{{ route('add_advertisements') }}"
                                class="btn btn-app waves-effect ml-3">ADD</a>
                            <button class="btn btn-secondary three-btn" onclick="html_table_to_excel('xlsx')">Excel</button>
                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Media Type</th>
                                        <th>Media</th>
                                        <th>Description</th>
                                        <th>Start Duration</th>
                                        <th>End Duration</th>
                                        <th>Link</th>
                                        <th>Banner Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            </table>
                            </tbody>
                            </table>

                            <table style="display: none" id="advertisement_list">
                                <thead>
                                    <tr>


                                        <th>Id</th>
                                        <th>Media Type</th>
                                        <th>Media</th>
                                        <th>Description</th>
                                        <th>Start Duration</th>
                                        <th>End Duration</th>
                                        <th>Link</th>
                                        <th>Banner Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata['id'] }}</td>
                                            <td>{{ $udata['media_type'] }}</td>
                                            <td>{{ $udata['description'] }}</td>
                                            <td>{{ $udata['start_date'] }}</td>
                                            <td>{{ $udata['end_date'] }}</td>
                                            <td>{{ $udata['link'] }}</td>
                                            <td>{{ $udata['name'] }}</td>
                                            <td>
                                                @if ($udata['is_active'] == 1)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif
                                            </td>
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
    <script src="{{ asset('public/assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.js"
        integrity="sha512-HSX6+785OA1Th/CvDy4O2giA2Bvr0Ex6M5yeh+PMomOnpDKBeEnTurP5sSO+jlHShGXku8UmG93POKvXYf3zEg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>




    <script type="text/javascript">
        var table_data = [{
                data: 'id',
                name: 'id',
                type: 'num'
            },
            {
                data: 'media_type',
                name: 'media_type',
                "width" : "100px"
            },
            {
                data: 'media',
                name: 'media',
                render: function(image, type, row) {
                    // console.log('hello',type)
                    // console.log('hello1',row.media_type)
                    // console.log('hello2',image)

                    return set_image(image, row.media_type)
                },
            },
            // {
            //     data: 'description',
            //     name: 'description'
            // },
            {
                data: 'description',
                name: 'description',
                "width" : "100px",
                render: function(data, type, full, meta) {
                    if (type === 'display' && data.length > 50) {
                        // Truncate the text and append dots
                        data = data.substr(0, 50) + '...';
                    }
                    return data;
                }
            },
            {
                data: 'start_date',
                name: 'start_date',
                "width" : "100px"
            },
            {
                data: 'end_date',
                name: 'end_date',
                "width" : "100px"

            },
            {
                data: 'link',
                name: 'link',
                "width" : "100px"
            },

            {
                data: 'name',
                name: 'name',
                "width" : "100px"
            },

            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'action',
                name: 'action',
            }
        ];

        function set_image(image, media_type) {
            if (media_type == 'image' && image != '') {
                // console.log('abnc','image',image)

                return `<img width="130" height="100" src="${image}"></img>`;
                // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${img_url}${image}"><img src="${img_url}${image}"  width="80" height="80"></a></div>`;

                // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
            } else if (media_type == 'video' && image != '') {
                // console.log('ccc','video',image)

                return `<video width="150" height="100"  controls>
    <source src="${image}" type="video/mp4"></video>`;
            } else {
                // console.log('aaa','fgfd',image)
                return "-N/A-";
            }
        }
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
                type: "GET",
                url: "{{ route('advertisement_list') }}",
                dataType: "json",
            },
            columns: table_data,
            columnDefs: [{
                    // 'word-break': 'break-all';
                    width: '10px',
                    targets: 6,
                }, //step 2, column 1 out of 4

            ],
            order: [
                [0, 'desc']
            ]
        });

        function html_table_to_excel(type) {
            // var today = new Date();
            var data = document.getElementById('advertisement_list');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'advertisement_' + 'list' + '.' + type)
        }

        function imprimir() {
            var divToPrint = document.getElementById("advertisement_list");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }

        function statusChanged(id, status) {
            // console.log("fkdkfjdf")
            // alert(status)
            var action = status == 1 ? 'inactive' : 'active';
            // alert(action)
            Swal.fire({
                title: "Are you sure ?",
                text: "You want to change status of Advertisement",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#263238",
                confirmButtonText: "Yes!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: "{{ route('advertisement_Status') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'action': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data)
                            if (action == "inactive") {
                                // alert('158')
                                Swal.fire("Active!", "Advertisement is active.", "success");
                                table.ajax.reload(null, false);
                            } else {
                                // alert('162')
                                Swal.fire("Inactive!", "Advertisement is inactive", "success");
                                table.ajax.reload(null, false);
                            }
                        }
                    });
                }
            })
        }

        function deletePost(id) {

            Swal.fire({
                title: 'Are you sure?',
                //   text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        // dataType: "json",
                        url: "{{ url('admin/advertisements_delete') }}/" + id,
                        success: function(data) {
                            // swal.fire("Delete!", "Your post has been deleted.", "success");
                            table.ajax.reload(null, false);
                            location.reload(true);
                        }
                    });
                }
            })

        }
    </script>

    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    </body>

    </html>
@endsection
