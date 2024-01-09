@extends('index')
@section('title', 'Contact Us')
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
                            <h2> CONTACT US LIST </h2>

                        </div>
                        <div class="body">
                            <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')"
                            style="margin-left: 96px;
                            padding-right: 13px;">Excel</button>
                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>Full Name</th>

                                        {{-- <th>Mobile number</th> --}}
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th style="width:200px;">Description</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                               
                                <tbody>


                            </table>
                            </tbody>
                            </table>
                            <table style="display: none" id="con">
                                <thead>
                                    <tr>


                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        {{-- <th>Mobile number</th> --}}
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        {{-- <th>Date</th> --}}

                                        {{-- <th>Action</th>          --}}

                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata['id'] }}</td>
                                            <td>{{ $udata['first_name'] }}</td>
                                            <td>{{ $udata['last_name'] }}</td>
                                            {{-- <td>{{$udata['profile_image']}}</td> --}}
                                            <td>{{ $udata['email'] }}</td>
                                            <td>{{ $udata['subject'] }}</td>
                                            <td>{{ $udata['description'] }}</td>
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
    <script src="{{ asset('public/assets/js/pages/tables/jquery-datatable.js') }}"></script>

    <script type="text/javascript">
        var table_data = [{
                data: 'id',
                name: 'id',
                type: 'num'
            },

            {
                data: 'full_name',
                name: 'full_name',
            },
          
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'subject',
                name: 'subject',
            },
            // {
            //     data: 'description',
            //     name: 'description',
            // },
            {
                data: 'description',
                name: 'description',
                render: function(data, type, full, meta) {
                    if (type === 'display' && data.length > 50) {
                        // Truncate the text and append dots
                        data = data.substr(0, 200) + '...';
                    }
                    return data;
                }
            },
            {
                data: 'insert_date',
                name: 'insert_date',
            },
            {
                data: 'status',
                name: 'status',
                //    orderable: false,
            },
            {
                data: 'action',
                name: 'action',
                // orderable: false,
            },
        ];


        // alert(table_data)
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
                url: "{{ route('contactus') }}",
                dataType: "json",
            },
            columns: table_data,
            order: [
                [0, 'desc']
            ]
        });

        function html_table_to_excel(type) {
            // var today = new Date();

            var data = document.getElementById('con');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'contactus_' + 'list' + '.' + type)
        }

        function imprimir() {
            var divToPrint = document.getElementById("con");
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
                text: "You want to change status of Templete",
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
                        url: "{{ route('contactus_status') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'action': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data)
                            if (action == "inactive") {
                                // alert('158')
                                Swal.fire("Active!", "Your status changed to active.", "success");
                                table.ajax.reload(null, false);
                            } else {
                                // alert('162')
                                Swal.fire("Inactive!", "Your status changed to inactive", "success");
                                table.ajax.reload(null, false);
                            }
                        }

                    });
                }
            })
        }
    </script>

@endsection
