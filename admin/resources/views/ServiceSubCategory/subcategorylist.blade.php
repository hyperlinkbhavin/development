<style> 

    .dt-buttons.btn-group {
      position: absolute;
      top: -48px;
      left: 85px !important;
  }
      </style>

@extends('index')
@section('title', 'Manage Service Category')
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
                            <h2>SERVICE SUBCATEGOTY LIST </h2>

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
                            <a style="color:black !important;" href="{{ route('add_subcat') }}" class="btn btn-app waves-effect ml-3">ADD</a>
                            <button class="btn btn-secondary three-btn" onclick="html_table_to_excel('xlsx')">Excel</button>
                            {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        {{-- <th>Category Id</th> --}}
                                        <th>Category name</th>
                                        <th>Subcategory Name</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                               
                                <tbody>

                            </table>
                            </tbody>
                            </table>
                            <table style="display: none" id="service_subcategories">
                                <thead>
                                    <tr>


                                         <th>Id</th>
                                            {{-- <th>Category Id</th> --}}
                                            <th>Category name</th>
                                            <th>Subcategory Name</th>
                                            <th>Status</th>



                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata['id'] }}</td>
                                            <td>{{ $udata['name'] }}</td>
                                            <td>{{ $udata['subcat_name'] }}</td>

                                            <td>
                                                @if ($udata['is_active'] == 1)
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
    {{-- <script src="{{asset('public/assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.js"
        integrity="sha512-HSX6+785OA1Th/CvDy4O2giA2Bvr0Ex6M5yeh+PMomOnpDKBeEnTurP5sSO+jlHShGXku8UmG93POKvXYf3zEg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script type="text/javascript">
        // alert('hello')         
        var table_data = [{
                data: 'id',
                name: 'id',
                type: 'num'
            },
            // {
            //     data: 'category_id',
            //     name: 'category_id',
            // },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'subcat_name',
                name: 'subcat_name',
            },

            {
                data: 'status',
                name: 'status',
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

                return `<video width="150" height="100"  controls>
    <source src="${image}" type="video/mp4"></video>`;

                // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
            } else {
                return "-N/A-";
            }
        }
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
                url: "{{ route('service_subcategories') }}",
                dataType: "json",
            },
            columns: table_data,
            order: [
                [0, 'desc']
            ]
        });

        function html_table_to_excel(type) {
            // var today = new Date();

            var data = document.getElementById('service_subcategories');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'service_subcategories_' + 'list' + '.' + type)
        }

        function imprimir() {
            var divToPrint = document.getElementById("service_subcategories");
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
                text: "You want to change status of Subcategory",
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
                        url: "{{ route('subcategories_Status') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'action': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data)
                            if (action == "inactive") {
                                // alert('158')
                                Swal.fire("Active!", "Subcategory is active.", "success");
                                table.ajax.reload(null, false);
                            } else {
                                // alert('162')
                                Swal.fire("Inactive!", "Subcategory is inactive", "success");
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
                        url: "{{ url('admin/subcategories_delete') }}/" + id,
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
