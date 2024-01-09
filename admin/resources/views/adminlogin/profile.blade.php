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
                        <h2> Admin Profile Details </h2>

                    </div>
                    <div class="body">
                        <a href="{{ URL::previous() }}"  class="btn btn-raised waves-effect waves-float waves-red text-left"><i class="zmdi zmdi-arrow-left"></i></a>

                        {{-- <button class="btn btn-secondary" onclick="html_table_to_excel('xlsx')">Export</button>
                        <button class="btn btn-secondary" onclick="imprimir()">Print</button> --}}
                        <table id="customer_list" class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    
                                    <th>Id</th>
                                    <th>Email</th>
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
<script src="{{asset('public/aassets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<script src="{{asset('public/aassets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 

<!-- Jquery DataTable Plugin Js --> 
<script src="{{asset('public/aassets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('public/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

<script src="{{asset('public/assets/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js --> 
<script src="{{asset('public/assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.js" integrity="sha512-HSX6+785OA1Th/CvDy4O2giA2Bvr0Ex6M5yeh+PMomOnpDKBeEnTurP5sSO+jlHShGXku8UmG93POKvXYf3zEg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript"> 
    var table_data = [{
            data: 'id',
            name: 'id',
            type: 'num'
        },   
        {
            data: 'email',
            name: 'email'
        },
       
        {
            data: 'action',
            name: 'action'
        }
    ];

    function set_image(image) {
        if (image && image != '') {
            return `<div class="image-popup-no-margins" title="click to see full image"><a href="${img_url}${image}"><img src="${img_url}${image}"  width="80" height="80"></a></div>`;
        } else {
            return "-N/A-";
        }
    }
    // alert(table_data)
    // console.log(table_data);
    var table = $('.js-exportable').DataTable({
        serverSide: true,
        processing: true,
        "responsive": true,
        "lengthChange": false,
        ajax: {
            type: "GET",
            url: "{{ route('profile') }}",
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

        // function imprimir() {
        //     var divToPrint = document.getElementById("cooking_report");
        //     newWin = window.open("");
        //     newWin.document.write(divToPrint.outerHTML);
        //     newWin.print();
        //     newWin.close();
        // }

   
</script>

<script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
</body>
</html>
@endsection