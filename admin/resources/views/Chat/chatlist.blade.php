@extends('index')
@section('title','Manage Customers')
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
                        <h2> CHAT ROOM LIST </h2>

                    </div>

                    {{-- Nearly up to date! Relaunch Chrome to finish updating.
                    Version 99.0.4844.74 (Official Build) (64-bit) --}}
                    <div class="body">
                        <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')" style="margin-left: 96px;
                        padding-right: 13px;">Excel</button>
                        {{-- <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                        @if (\Session::get('success'))
                        <div class="alert alert-success alert-dismissable zoomIn animated col-lg-3 col-md-3 col-sm-3 col-xs-6 mt-2"
                            style="margin-left: 1105px;" id="message">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>{{
                            \Session::get('success') }}<a class="alert-link" href="#"></a>
                        </div>
                        @endif
                        <table id="chat"
                            class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>

                                    <th>Id</th>
                                    <th>Created date</th>                                  
                                    <th>Modified date</th>                                  
                                    <th>User Name</th>
                                    <th>Provider Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                           
                            <tbody>

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
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
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
            data: 'date_formatted',
            name: 'date_formatted',
        },
        {
            data: 'modify_date',
            name: 'modify_date',
        },
        // {
        //     data: 'profile_image',
        //     name: 'profile_image',
        //     render: function(image) {
        //         return set_image(image)
        //     },
        // },
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
            data: 'customer_names',
            name: 'customer_names',
        },

    //     {
    //     data: "full_name",
    //     render: function (data, type, row, meta) {
    //         if (type === "display") {
    //             data = '<a style="color:black" href="{{ url('view_user_data') }}/" + id>' + row.full_name + '</a>';
    //         }
    //         return data;
    //     }
    // },
        {
            data: 'provider_names',
            name: 'provider_names'
        },
        // {
        //     data: 'insert_datetime',
        //     name: 'insert_datetime'
        // },
        // {
        //     data: 'mobile',
        //     name: 'mobile',
        // },
      
       
  
        {
            data: 'action',
            name: 'action',
            // orderable: false,
            //     searchable: false,
        }
    ];
    function set_image(image) {
        if (image && image != '') {

       return `<img width="150" height="100" src="${image}"></img>`;
        // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${img_url}${image}"><img src="${img_url}${image}"  width="80" height="80"></a></div>`;

            // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
        } else {
            return "-N/A-";
        }
    }
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
        "iDisplayLength": 20,

        ajax: {
            type: "GET",
            url: "{{ route('manage_chat') }}",
            dataType: "json",
        },
        // "buttons": ['excel', 'pdf','print'],
        columns: table_data,
        
        order: [
            [0, 'desc']
        ]
    });

    function html_table_to_excel(type) {
            // var today = new Date();
           
            var data = document.getElementById('chat');
            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, 'chat_' + 'list' + '.' + type)
        }

        function imprimir() {
            var divToPrint = document.getElementById("chat");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
  

</script>

<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
</body>

</html>
@endsection