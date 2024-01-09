{{-- <style>
    .select2-selection.select2-selection--single {
    margin-left: 26px;
}
</style> --}}
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
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-parpl div5">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $provider->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Active Providers</p>
                            </center>
                            <center><a href="{{ route('advertisement_list') }}"
                                    style="background: linear-gradient(45deg, #a890d3, #edbae7) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                                    margin-top: 5px;"></a>
                            </center>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-seagreen div3">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $delete->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Deleted Providers</p>
                            </center>
                            <center><a href=""
                                    style="    background: linear-gradient(45deg, #8ed8ec, #85f7b5) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
                                margin-top: 5px;"></a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>PROVIDER LIST </h2>
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
                            <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')"
                                style="margin-left: 96px;   
                            padding-right: 13px;">Excel</button>


                            <select class="js-example-basic-single mr-4" id="provider_status"
                                style="margin-left: 30px !important; width: 250px;" name="state"
                                onchange="changeStatus()">
                                <option>All</option>
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="blocked">Blocked</option>
                            </select>

             

                            <select class="js-example-basic-single filterclass" name="country_code" id="country_code"
                                style="width: 250px">
                                <option value="0">All</option>
                                @foreach ($code as $k)
                                    {{ $k }}
                                    <option value="{{ $k->country_code }}">
                                        {{ $k->country_code }} {{ $k->name }}
                                    </option>
                                @endforeach
                            </select>


                            <select class="js-example-basic-single filterclass" name="city" id="city"
                                style="width: 250px" onchange="changeStatus()">
                                <option value="0">All</option>
                                @foreach ($city as $k)
                                    {{ $k }}

                                    <option value="{{ $k->city }}">{{ $k->city }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Provider Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>City</th>
                                        <th style="width:10px;">Business name</th>
                                        <th style="width:100px;">Registered date</th>
                                        <th>Last Login</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            </table>
                            <table style="display: none" id="service_provider_list">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Provider Name</th>
                                        {{-- <th>Profile Image</th> --}}
                                        <th>Email</th>
                                        <th>Moblie</th>
                                        <th>City</th>
                                        <th>Business name</th>
                                        <th>Registered date</th>
                                        <th>Last Login</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata['id'] }}</td>
                                            <td>{{ $udata['full_name'] }}</td>
                                            <td>{{ $udata['email'] }}</td>
                                            <td>{{ $udata['country_code'] }} {{ $udata['mobile'] }}</td>
                                            <td>{{ $udata['city'] }}</td>
                                            <td>{{ $udata['business_name'] }}</td>
                                            <td>{{ $udata['insert_date'] }}</td>
                                            <td>{{ $udata['last_login'] }}</td>
                                            <td>
                                                @if ($udata['is_approved'] == 1)
                                                    Approved
                                                @elseif ($udata['is_approved'] == 2)
                                                    Rejected
                                                @else
                                                    Pending
                                                @endif
                                            </td>
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
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>

    <script src="{{ asset('public/assets/bundles/mainscripts.bundle.js') }}"></script><!-- Custom Js -->
    <script src="{{ asset('public/assets/js/pages/tables/jquery-datatable.js') }}"></script>
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

            // {
            //     data: 'profile_image',
            //     name: 'profile_image',
            //     render: function(image) {
            //         return set_image(image)
            //     },
            // },

            // {
            //     data: 'provide_name',
            //     name: 'provide_name',
            //     // searchable: true,
            // },

            {
                data: 'profile_image',
                name: 'profile_image',
                "width": "125px",

                orderable: false,
                searchable: false,
                render: function(data, type, row, image) {
                    console.log(row)

                    return row.provide_name + '<br><br>' + set_image(row.profile_image) + '';
                },
            },
            // {
            //     data: 'profile_image',
            //     name: 'profile_image',
            //     orderable: false,
            //     searchable: false,
            //     render: function(image) {
            //         return set_image(image)
            //     },
            // },
            {
                data: 'email',
                name: 'email',
                "width": "100px",
            },
            {
                data: 'phone',
                name: 'phone',
                // "width" : "100px",

            },
            {
                data: 'city',
                name: 'city',
                width: '100px'
            },
            {
                data: 'business_name',
                name: 'business_name',
                "width": "100px",

            },
            // {
            //     data: 'insert_date',
            //     name: 'insert_date',
            // },
            // {
            //     data: 'last_login',
            //     name: 'last_login',
            // },

            {
                data: 'insert_date',
                name: 'insert_date',
                // orderable: false,
                // searchable: false,
                // render: function(data, type, row) {
                //     // console.log(row.last_login == null)
                //     if (row.last_login == null) {
                //         return row.insert_date;
                //     } else {
                //         return row.insert_date + '<br><br><b>Last Login</b> <br>' + row.last_login + '';
                //     }


                // },
            },
            {
                data: 'last_login',
                name: 'last_login',
            },
            {
                data: 'status',
                name: 'status',
                "width": "100px",

                // orderable: false,
                // searchable: false,
            },
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

        function changeStatus() {
               
            table.draw();
        }
        // function set_image(image) {
        //     if (image && image != '') {

        //    return `<video width="150" height="100"  controls>
    // <source src="${image}" type="video/mp4"></video>`;

        //         // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
        //     } else {
        //         return "-N/A-";
        //     }
        // }
        // alert(table_data)
        //     $('#provider_status').on('change',function() {
        //         alert('hhh')
        //     table.draw();
        // });
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
                type: "Post",
                url: "{{ route('service_provider_filter') }}",
                dataType: "json",
                data: function(d) {
                    d.filter_status = $('#provider_status').val();
                    d.country = $('#country_code').val()
                    d.city = $('#city').val()
                    // d.end_date = $('#end_date').val();
                }
            },
            columns: table_data,
            order: [
                [0, 'desc']
            ]
        });

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

                        console.log(response)
                        // console.log(response[0].city);
                        $('#city').html('<option value="0" selected>All</option>');
                        $.each(response.city, function(key, value) {

                            console.log(value.city)
                            $("#city").append('<option value="' + value
                                .city + '" >' + value.city + '</option>');
                        });
                        table.draw();

                        // $('#sponsor_ids').empty()
                        // $.each(response.user, function(key, value) {
                        //     $('#sponsor_ids').append('<option value="' + value.id +
                        //         '">' + value.first_name + ' ' + ' ' + value
                        //         .last_name + ' (' + value.email + ')' +
                        //         '</option>');
                        // })

                    }
                })
            })
        })

        function html_table_to_excel(type) {
            // var today = new Date();

            var data = document.getElementById('service_provider_list');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'service_provider_' + 'list' + '.' + type)
        }

        function imprimir() {
            var divToPrint = document.getElementById("service_provider_list");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }

        // function statusChanged(id, status) {
        //     // console.log("fkdkfjdf")
        //     // alert(status)
        //     var action = status == 1 ? 'inactive' : 'active';
        //     // alert(action)
        //     Swal.fire({
        //         title: "Are you sure ?",
        //         text: "You want to change status of Templete",
        //         type: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#263238",
        //         confirmButtonText: "Yes!",
        //         closeOnConfirm: false,
        //         showLoaderOnConfirm: true,

        //     }).then((result) => {
        //         $.ajax({
        //             type: "GET",
        //             dataType: "json",
        //             url: '/status_list_managevideoes',
        //             data: {
        //                 "_token": "{{ csrf_token() }}",
        //                 'action': action,
        //                 'id': id
        //             },
        //             success: function(data) {
        //                 console.log(data)
        //                 if (action == "inactive") {
        //                     // alert('158')
        //                     Swal.fire("Active!", "Your status changed to active.", "success");
        //                     table.ajax.reload(null, false);
        //                 } else {
        //                     // alert('162')
        //                     Swal.fire("Inactive!", "Your status changed to inactive", "success");
        //                     table.ajax.reload(null, false);
        //                 }
        //             }
        //         });
        //     })
        // }

        function statusChanged(id, status) {
            // alert(status)
            var action = status == 1 ? 'block' : 'unblock';
            // alert(status)
            // alert(action)
            Swal.fire({
                title: "Are you sure ?",
                text: "You want to change status of Provider",
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
                        url: "{{ route('provider_Status') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'action': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data)
                            if (action == "unblock") {
                                // alert('158')
                                Swal.fire("Block!", "Provider status changed to unblock.", "success");
                                table.ajax.reload(null, false);
                            } else {
                                // alert('162')
                                Swal.fire("Unblock!", "Provider status changed to block", "success");
                                table.ajax.reload(null, false);
                            }
                        }
                    });
                }

            })
        }


        function statusApprove(id, status) {
            // alert(status)
            var action = status == 1 ? 'Approve' : 'Reject';
            // alert(status)
            // alert(action)
            Swal.fire({
                title: "Are you sure ?",
                // text: "You want to change status of User",
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
                        url: "{{ route('provider_Approve') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'action': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data)
                            if (action == "Reject") {

                                Swal.fire("Reject!", "Provider status changed to Reject", "success");
                                table.ajax.reload(null, false);
                            } else {

                                Swal.fire("Approve!", "Provider status changed to Approve.", "success");
                                table.ajax.reload(null, false);
                            }
                        }
                    });
                }

            })
        }

        function statusReject(id, status) {
            // alert(status)
            var action = status == 1 ? 'Approve' : 'Reject';
            // alert(status)
            // alert(action)
            Swal.fire({
                title: "Are you sure ?",
                text: "You want to Approve",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#263238",
                confirmButtonText: "Approve!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: "{{ route('provider_Approve') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'action': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data)
                            if (action == "Reject") {

                                Swal.fire("Reject!", "Provider status changed to Reject", "success");
                                table.ajax.reload(null, false);
                            } else {

                                Swal.fire("Approve!", "Provider status changed to Approve.", "success");
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
                                    // Swal.fire("Deleted!", "provider account is deleted.", "success");
                                    // table.ajax.reload(null, false);
                                    location.reload()

                                } else {
                                    // alert('2')
                                    // Swal.fire("Deleted!", "provider account is deleted.", "success");
                                    // table.ajax.reload(null, false);
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
                                    // Swal.fire("Deleted!", "provider account is deleted.", "success");
                                    // table.ajax.reload(null, false);
                                    location.reload()

                                } else {
                                    // alert('4')
                                    // Swal.fire("Reopen!", "provider account is reopned", "success");
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
                        url: "{{ url('admin/provider_delete') }}/" + id,
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
