@extends('index')
@section('title', 'Manage Reels')
@section('main')

    <section class="content">
        <div class="block-header">
            <div class="row">


            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">

                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="card l-blue div6">
                        <div class="body">
                            <center>
                                <h3 class="m-t-0 count">{{ $story->count() }}</h3>
                            </center>
                            <center>
                                <p class="m-b-0">Total Story</p>
                            </center>
                            <center><a href=""
                                    style="background: linear-gradient(45deg, #72c2ff, #86f0ff) !important; color:rgba(0, 0, 0, 0.575);     height: 37px;
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
                            <h2>SERVICE PROVIDER STORY LIST </h2>

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
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>Provider Name</th>
                                        <th>Story</th>
                                        <th>Media Type</th>
                                        <th>Created Date</th>
                                        <th style="width:200px"> Description</th>
                                        <th>Likes</th>
                                        <th>Views</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                             
                                <tbody>

                            </table>
                            </tbody>
                            </table>

                            <table style="display: none" id="reel_list">
                                <thead>
                                    <tr>


                                        <th>Id</th>
                                        <th>Provider Name</th>
                                        {{-- <th>Reel</th> --}}
                                        <th>Media Type</th>
                                        <th>Likes</th>
                                        <th>views</th>
                                        <th>Action</th>



                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($data as $udata)
                                        <tr>
                                            <td>{{ $udata['id'] }}</td>
                                            <td>{{ $udata['full_name'] }}</td>
                                            <td>{{ $udata['media_type'] }}</td>
                                            <td>{{ $udata['likes'] }}</td>
                                            <td>{{ $udata['view'] }}</td>

                                            <td>
                                                @if ($udata['is_active'] == 1)
                                                    Unblock
                                                @else
                                                    Block
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
                data: 'provider_names',
                name: 'provider_names',
            },
            {
                data: 'media_name',
                name: 'media_name',
                render: function(image, type, row) {
                    return set_image(image, row.media_type)
                },
                orderable: false,

            },
            {
                data: 'media_type',
                name: 'media_type',

            },
            {
                data: 'insert_date',
                name: 'insert_date',
            },
            {
                data: 'caption',
                name: 'caption',
            },
            {
                data: 'like',
                name: 'like',

            },
            {
                data: 'view',
                name: 'view',

            },
            {
                data: 'action',
                name: 'action',

            }
        ];

        // function set_image(image) {
        //     if (image && image != '') {

        //    return `<video width="150" height="100"  controls>
    // <source src="${image}" type="video/mp4"></video>`;

        //         // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
        //     } else {
        //         return "-N/A-";
        //     }
        // }
        function set_image(image, media_type) {
            if (media_type == 'image' && image != '') {
                console.log('abnc', 'image', image)

                return `<img width="150" height="100" src="${image}"></img>`;
                // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${img_url}${image}"><img src="${img_url}${image}"  width="80" height="80"></a></div>`;

                // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
            } else if (media_type == 'video' && image != '') {
                console.log('ccc', 'video', image)

                return `<video width="150" height="100"  controls>
    <source src="${image}" type="video/mp4"></video>`;
            } else {
                console.log('aaa', 'fgfd', image)
                return "-N/A-";
            }
        }
        // function set_image(image) {
        //     if (image && image != '') {

        //    return `<img width="150" height="100" src="${image}"></img>`;
        //     // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${img_url}${image}"><img src="${img_url}${image}"  width="80" height="80"></a></div>`;

        //         // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
        //     } else {
        //         return "-N/A-";
        //     }
        // }
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
                url: "{{ route('reel_list') }}",
                dataType: "json",
            },
            columns: table_data,
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                switch (aData['is_delete']) {
                    case 1:
                        $('td', nRow).css('background-color', '#dacfcf')
                }
            },

            order: [
                [0, 'desc']
            ]
        });

        function html_table_to_excel(type) {
            // var today = new Date();

            var data = document.getElementById('reel_list');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'reel_' + 'list' + '.' + type)
        }

        function imprimir() {
            var divToPrint = document.getElementById("reel_list");
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
                text: "You want to change status of reel",
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
                        url: "{{ route('reel_Status') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'action': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data)
                            if (action == "unblock") {
                                // alert('158')
                                Swal.fire("Block!", "Reel status changed to block.", "success");
                                table.ajax.reload(null, false);
                            } else {
                                // alert('162')
                                Swal.fire("Unblock!", "Reel status changed to unblock", "success");
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
                        url: "{{ url('admin/reel_delete') }}/" + id,
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
