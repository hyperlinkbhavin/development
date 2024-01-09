@extends('index')
@section('title', 'ContactUs View')
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
                                        <a href="{{ URL::previous() }}"
                                            class="btn btn-raised waves-effect waves-float waves-red text-left"><i
                                                class="zmdi zmdi-arrow-left"></i></a>
                                    </div>
                                </div>

                            <h4>Sorry ! You have no access to send notification.😔 </h4>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      
    </section>
    {{-- <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
    </body>

    </html>
@endsection
