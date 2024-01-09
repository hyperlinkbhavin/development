@extends('index')
@section('title','Manage Service Category')
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
                    
                        <h2>SERVICE TIMING LIST </h2>
                       
                    </div>
                  
                    <div class="body">
                        <div class="col-12 text-left">
                            <a href="{{ URL::previous() }}"  class="btn btn-raised waves-effect waves-float waves-red text-left"><i class="zmdi zmdi-arrow-left"></i></a>
                        </div>
                        {{-- <a href="{{ route('add_cat') }}" class="btn btn-app waves-effect ml-3">ADD</a> --}}
                        <input type="hidden" value="{{$user}}" id="service_id">

                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    
                                    <th>Id</th>
                                    <th>Day</th>
                                    <th>Open Time</th>
                                    <th>Close Time</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Day</th>
                                    <th>Open Time</th>
                                    <th>Close Time</th>
                                    <th>Status</th>                          
                                </tr>               
                            </tfoot>
                            <tbody>
                            
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Jquery Core Js --> 
<script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<script src="{{asset('public/assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 

<!-- Jquery DataTable Plugin Js --> 
<script src="{{asset('public/assets/bundles/datatablescripts.bundle.js')}}"></script>
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
// alert('hhgh')      
      var table_data = [
        {
            data: 'id',
            name: 'id',
            type: 'num'
        },
        {
            data: 'day',
            name: 'day',
        },
       
        {
            data: 'time',
            name: 'time',
            render: function(time,type,row) {
                // console.log('hello',type)
                // console.log('hello1',row.status)
                // console.log('hello2',time)

                return close_time(time,row.status)
            },
       
        },
        {
            data: 'end_time',
            name: 'end_time',
            render: function(time,type,row) {
                // console.log('hello',type)
                // console.log('hello1',row.status)
                // console.log('hello2',time)

                return close_time(time,row.status)
            },
       
        },
        {
            data: 'status',
            name: 'status',
            orderable: false,
           

        },
    ];

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    // alert(table_data)
    var table = $('.js-exportable').DataTable({
        serverSide: true,
        processing: true,
        "responsive": true,
        "lengthChange": false,
        ajax: {
            type: "post",
            url: "{{ route('provider_time_view') }}",
            data : {'id' : document.getElementById('service_id').value},
            dataType: "json",
        },
        columns: table_data,
        order: [
            [0, 'desc']
        ]
    });

    function close_time(time,status) {
        if (status == 'close') {
            // console.log('abnc','image',image)

       return '-';
        // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${img_url}${image}"><img src="${img_url}${image}"  width="80" height="80"></a></div>`;

            // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
        }
        
        else {
            // console.log('aaa','fgfd',image)
            return time;
        }
    }
    </script>

<script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
</body>
</html>
@endsection