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
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-blue div5">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $customer->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Active Users</p>
                            </center>
                            <center><a href=""
                                    style="background: linear-gradient(45deg, #fda582, #f7cf68) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                            margin-top: 5px;"></a>
                            </center>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-amber div4">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $delete->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Deleted Users</p>
                            </center>
                            <center><a href=""
                                  
                                    style="background: linear-gradient(45deg, #fda582, #f7cf68) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                                margin-top: 5px;"></a></center>
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">


                    <div class="card">
                        <div class="header">
                            <h2> USERS LIST </h2>

                        </div>


                        <div class="body">

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
                                class="table table-bordered table-striped table-hover dataTable js-exportable display nowrap">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>User name</th>
                                        {{-- <th>Profile Image</th> --}}
                                        <th>Email</th>
                                        <th>Moblie</th>
                                        <th>City</th>
                                        <th>Coin</th>
                                        <th>Registered date</th>
                                        <th>Last Login</th>

                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>

                            </table>
                            <table style="display: none" id="customer_list">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>User name</th>
                                        {{-- <th>Profile Image</th> --}}
                                        <th>Email</th>
                                        <th>Moblie</th>
                                        <th>City</th>
                                        <th>Registered date</th>
                                        <th>Last Login</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata['id'] }}</td>
                                            <td>{{ $udata['full_name'] }}</td>
                                            {{-- <td>{{ $udata['last_name'] }}</td> --}}
                                            {{-- <td>{{$udata['profile_image']}}</td> --}}
                                            <td>{{ $udata['email'] }}</td>
                                            <td>{{ $udata['country_code'] }} {{ $udata['mobile'] }}</td>
                                            <td>{{ $udata['city'] }}</td>
                                            <td>{{ $udata['insert_date'] }}</td>
                                            <td>{{ $udata['last_login'] }}</td>

                                            <td>
                                                @if ($udata['is_delete'] == 1)
                                                    Deleted
                                                @elseif ($udata['is_active'] == 1)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif
                                            </td>
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
    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('public/assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('public/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>

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


            // {
            //     data: 'profile_image',
            //     name: 'profile_image',
            //     render: function(image) {
            //         return set_image(image)
            //     },
            // },

            // {
            //     data: 'full_name',
            //     name: 'full_name',
            // },

            // {
            //     data: "full_name",
            //     render: function(data, type, row,image) {
            //         return row.full_name + '<br>' + row.profile_image + '';
                    
            //     }
            // },
            // {
            //     data: 'last_name',
            //     name: 'last_name'
            // },
            {
                data: 'profile_image',
                name: 'profile_image',
                orderable: false,
                searchable: false,
                render: function(data, type, row,image) {
                    console.log(row)
                    
                    return  row.full_name + '<br><br>' + set_image(row.profile_image) + '';
                },
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'phone',
                name: 'phone',
                searchable: true,
            },
            {
                data: 'city',
                name: 'city',
            },
            {
                data: 'coins',
                name: 'coins',
            },
            {
                data: 'insert_date',
                name: 'insert_date',
            },
            {
                data: 'last_login',
                name: 'last_login',
            },
            // {
            //     data: 'status',
            //     name: 'status',
            //     // orderable: false,
            //     // searchable: false,
            // },
            {
                data: 'action',
                name: 'action',
                // orderable: false,
                // searchable: false,
            }
        ];

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
            // scrollX: true,
            ajax: {
                type: "GET",
                url: "{{ route('customers') }}",
                dataType: "json",
            },
            columns: table_data,

            order: [
                [0, 'desc']
            ]
        });




        function html_table_to_excel(type) {
            // var today = new Date();

            var data = document.getElementById('customer_list');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'customer_' + 'list' + '.' + type)
        }


        function imprimir() {
            var divToPrint = document.getElementById("customer_listt");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }


        function statusChanged(id, status) {
            // alert(status)
            var action = status == 1 ? 'block' : 'unblock';
            // alert(status)
            // alert(action)
            Swal.fire({
                title: "Are you sure ?",
                text: "You want to change status of User",
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
                        url: "{{ route('User_Status') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'action': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data)
                            if (action == "unblock") {
                                // alert('158')
                                Swal.fire("Block!", "User status changed to unblock.", "success");
                                table.ajax.reload(null, false);
                            } else {
                                // alert('162')
                                Swal.fire("Unblock!", "User status changed to block", "success");
                                table.ajax.reload(null, false);
                            }
                        }
                    });
                }

            })
        }


        function statusChangedd(id, status) {
            // alert(status)
            var action = status == 0 ? 'deleted' : 'delete';
            // alert(status)
            // alert(action)
            if (action = status == 1) {
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
                            type: "post",
                            dataType: "json",
                            url: "{{ route('User_block_Status') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'action': status,
                                'id': id
                            },
                            success: function(data) {
                                // console.log(data)
                                if (action == "deleted") {
                                    // alert('1') 
                                    // Swal.fire("Deleted!", "customer account is deleted", "success");
                                    location.reload()
                                } else {
                                    // alert('2')
                                    // Swal.fire("Deleted!", "customer account is deleted", "success");
                                    location.reload()

                                }
                            }
                        });
                    }

                })
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    //   text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Reopen it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            dataType: "json",
                            url: "{{ route('User_block_Status') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'action': status,
                                'id': id
                            },
                            success: function(data) {
                                // console.log(data)
                                if (action == "delete") {
                                    // alert('3')
                                    // Swal.fire("Deleted!", "customer account is deleted.", "success");
                                    // table.ajax.reload(null, false);
                                    location.reload()
                                } else {
                                    // alert('4')
                                    // Swal.fire("Reopen!", "customer account is reopened", "success");
                                    // table.ajax.reload(null, false);
                                    location.reload()

                                }
                            }
                        });
                    }

                })
            }

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
                        url: "{{ url('admin/video_delete') }}/" + id,
                        success: function(data) {
                            // console.log(data)
                            // swal.fire("Delete!", "Your post has been deleted.", "success");
                            // table.ajax.reload(null, false);
                            // location.reload();
                        }
                    });
                }
            })


        }
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.16.0/dist/pdf-lib.js"></script> --}}
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

    <script src="{{ asset('public/assets/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
    </body>

    </html>
@endsection
