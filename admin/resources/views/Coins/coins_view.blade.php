@extends('index')
@section('title','form')
@section('main')



    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                   
                </div>           
            </div>
        </div>
        <div class="container-fluid">
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>Manage Coins </h2>
                           
                        </div>
                        <div class="body">
                            {{-- <h2 class="card-inside-title">User data Form</h2> --}}
                            <div class="col-12 text-left">
                                {{-- <a href="{{ URL::previous() }}"  class="btn btn-raised waves-effect waves-float waves-red text-left"><i class="zmdi zmdi-arrow-left"></i></a> --}}
                            </div><br>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <form class="col-lg-12" action="{{ route('update_coins') }}" method="post" data-parsley-validate="">
                                        @csrf
                                        <input name="id" value="{{$data[0]['id']}}" hidden>

                                        
                                           
                                        {{-- <div class="form-line">
                                                <input type="text" value="{{$sign_up_coins}}" name="sign_up_coins" id="sign_up_coins" class="form-control"  placeholder="Order Commission" data-parsley-required> --}}
                                          
                                            {{-- @if($response['error'] = 1)
                                            <span style="color: red">Please Enter Valid Current Password</span><br>
                                            @endif    --}}

                                                {{-- <span style="color: red">@error('sign_up_coins'){{$message}}@enderror</span><br>
                                            </div>
                                        </div> --}}
                                   <label for="name">1$ for Coin</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="doller" value="{{$a  ? '' : ''}} {{$data[0]['doller']}}" id="doller" class="form-control" required
                                                placeholder="Enter doller"  required="">
        
                                        </div>
                                    </div>
                                        <label for="name">SignUp coins</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="sign_up_coins" value="{{$data[0]['sign_up_coins']}}" id="sign_up_coins" class="form-control" required
                                                    placeholder="Enter coins"  required="">
            
                                            </div>
                                        </div>

                                        <label for="name">Referral coins</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="referral_coins" value="{{$data[0]['referral_coins']}}" id="referral_coins" class="form-control" required
                                                    placeholder="Enter coins"  required="">
            
                                            </div>
                                        </div> <label for="name">Review coins</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="review_coins" value="{{$data[0]['review_coins']}}" id="review_coins" class="form-control" required
                                                    placeholder="Enter coins"  required="">
            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="text-center">
                                                <a href="{{route('dashboard')}}" class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px"> Back </a>
                                                <input type="submit"  class="btn btn-raised btn-primary m-t-15 waves-effect" style="background-color:#8f75d3;border:none;height:40px;width:80px" value="Update">  
                                                <!-- <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect">SUBMIT</button> -->
                                            </div>
                                        </div>
                                    </form>
                                               
                                </div>
                            </div>                         
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    {{-- <script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->  --}}
</body>
</html>
    
@endsection