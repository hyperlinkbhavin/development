@extends('index')
@section('title','Provider View')
@section('main')
<section class="content">
   
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 mt-5">
                    <div class="card member-card">
                        <div class="header">
                            <div class="col-12 text-left">
                                <a href="{{ route('service_provider') }}"  class="btn btn-raised waves-effect waves-float waves-red text-left"><i class="zmdi zmdi-arrow-left"></i></a>
                            </div>
                        </div>
                  
                        <div class="member-img" style="margin-top:0px !important;">
                            <!-- margin-right:1000px; -->
                           
                        </div>
                        <div class="body">
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="m-t-0"><b>Provider Information</b></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-box m-t-20 text-left m-l-10">
                                        <div class="p-20">
                                        
                                                
                                                <div class="about-info-p">
                                                    <strong>Image</strong>
                                                    <br>
                                                    <img src="{{ "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/user/".$user->profile_image }}" height="100px" width="120px"/>

                                                </div><br>
                                                <strong>Provider Name</strong>
                                                <br>
                                                <p class="text-muted" > {{$user['first_name']}} {{$user['last_name']}}</p>
                                               
                                            </div>
                                            <div class="about-info-p">
                                                <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">{{$user['email']}}</p>
                                            </div>
                                            @if (count($business_name) > 0)
                                            <div class="about-info-p">
                                                <strong>Business name</strong>
                                                <br>
                                                <p class="text-muted">{{$business_name[0]->business_name}}</p>
                                            </div>
                                            @endif
                                          
                                           
                                            <div class="about-info-p">
                                                <strong>Mobile Number</strong>
                                                <br>
                                                <p class="text-muted">{{$user['country_code']}} {{$user['mobile']}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>City</strong>
                                                <br>
                                                <p class="text-muted">{{$user['city']}}, {{$country->c_name}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>Number of Categories</strong>
                                                <br>
                                                <p class="text-muted">{{$category->count()}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>Number of Services</strong>
                                                <br>
                                                <p class="text-muted">{{$service->count()}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>Number of Story</strong>
                                                <br>
                                                <p class="text-muted">{{$reels_count->count()}}</p>
                                            </div>
                                            <div class="about-info-p">
                                                <strong>IP Address</strong>
                                                <br>
                                                <p class="text-muted">{{$ip[0]['ip']}}</p>
                                            </div>    
                                             <div class="about-info-p">
                                                <strong>Device Type</strong>
                                                <br>
                                                <p class="text-muted">{{$ip[0]['device_type']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                                </div>
                               
                            </div> 
                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2> BUSINESS DETAILS </h2>

                </div>
                <div class="body">
             
                </div>
                <input type="hidden" value="{{$user['id']}}" id="provider_id">
                <table class="table table-bordered table-striped table-hover dataTable js-exportablee">
                    <thead>
                        <tr>

                            <th>Id</th>
                            <th>Business Name</th>
                            <th>Logo</th>
                            <th>Description</th>
                            <th>Website</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Registration Number</th>
                            <th style="width : 80px !important;">Address</th>
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

<div class="container-fluid">

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2> SERVICE DETAILS </h2>

                </div>
                {{-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" class="form-control" id="from_date" name="from_date">
                        </div>
                    </div>
                </div> --}}
                <div class="body">
             
                </div>
                <input type="hidden" value="{{$user['id']}}" id="provider_id">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>


                            <th>Id</th>
                            <th>Service name</th>
                            <th>Category name</th>
                            <th>Sub-category name</th>
                            <th>Description</th>
                            <th>Minimum Rate</th>
                            <th>Maximum Rate</th>
                            {{-- <th>Service Logo</th> --}}
                            <th>Service Time</th>
                            <th>Service Images</th>
                           

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
{{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
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
{{-- <script src="{{asset('public/assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.js" integrity="sha512-HSX6+785OA1Th/CvDy4O2giA2Bvr0Ex6M5yeh+PMomOnpDKBeEnTurP5sSO+jlHShGXku8UmG93POKvXYf3zEg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script type="text/javascript"> 
// alert('hello')         
      var table_data = [
        {
            data: 'id',
            name: 'id',
            type: 'num'
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
        //  {
        //     data: 'service_logo',
        //     name: 'service_logo',  
        //      render: function(image) {
        //         return set_image(image)
        //     },
        // },  
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
    // alert(table_data)
    var table = $('.js-exportable').DataTable({
        serverSide: true,
        processing: true,
        "responsive": true,
        "lengthChange": false,
        "iDisplayLength": 20,

        ajax: {
            type: "post",
            url: "{{ route('provider_list') }}"  ,
            data : {'id' : document.getElementById('provider_id').value},
            
            dataType: "json",
        },
        columns: table_data,
        order: [
            [0, 'desc']
        ]
    });

    
        let table_data1 = [
        {
            data: 'id',
            name: 'id',
            type: 'num'
        },
        {
            data: 'business_name',
            name: 'business_name',
          
        },
        {
            data: 'logo',
            name: 'logo',
            render: function(image) {
                return set_image(image)
            },
        },
    
        {
            data: 'description',
            name: 'description',
        },
       
        {
            data: 'link',
            name: 'link'
        }, 
         {
            data: 'phone',
            name: 'phone'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'registration_number',
            name: 'registration_number'
        },
        {
            data: 'address',
            name: 'address'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            // searchable: false,
        },
    ];
    function set_image(image) {
        if (image && image != '') {
            var image_url = "{{url('admin/view_image/')}}" + "/" + btoa(image);
            return `<div  title="click to see full image"><a href="${image_url}" class="image-popup"  width="130" height="100"><img src="${image}"  width="130" height="100"><a></div>`;
    //    return `<img width="150" height="100" src="${image}"></img>`;
        // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${img_url}${image}"><img src="${img_url}${image}"  width="80" height="80"></a></div>`;

            // return `<div class="image-popup-no-margins" title="click to see full image"><a href="${image}"><img src="${image}"  width="80" height="80"></a></div>`;
        } else {
            return "-N/A-";
        }
    }
    let table1 = $('.js-exportablee').DataTable({
        serverSide: true,
        processing: true,
        "responsive": true,
        "lengthChange": false,
        "iDisplayLength": 20,

        ajax: {
            type: "post",
            url: "{{ route('provider_business_list') }}"  ,
            data : {'id' : document.getElementById('provider_id').value},
            
            dataType: "json",
        },
        columns: table_data1,
        order: [
            [0, 'desc']
        ]
    });
    

     
    </script>

<script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<!-- Jquery Core Js --> 

</body>
</html>
@endsection