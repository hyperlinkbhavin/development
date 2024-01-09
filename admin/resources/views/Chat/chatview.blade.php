<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bawabat Admin Panel</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
        rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/css/chat.css')}}">

<style> 

.text-muted {
    color: #ffffff!important;
}
.mesgs {
    /* float: left; */
    padding: 30px 15px 0 25px;
    width: 100%;
    height: 100%;
    /* margin-right: -99px; */
    margin-left: 120px;
}
.received_withd_msg p {
    background: #bf2020 none repeat scroll 0 0;
    border-radius: 3px;
    color: #646464;
    font-size: 14px;
    margin: 0;
    padding: 5px 10px 5px 12px;
    width: 100%;
}
.sent_msg p {
    background: #D85A25 none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 14px;
    margin: 0;
    color: #fff;
    padding: 5px 10px 5px 12px;
    width: 100%;
}
</style>
    @extends('index')
    @section('title','Manage Customers')
    @section('main')
   
    <div class="container" style="margin-top: 100px">
        <div class="col-12 text-left">
            <a href="{{ URL::previous() }}" style="background-color: white;"  class="btn btn-raised waves-effect waves-float waves-red text-left"><i class="zmdi zmdi-arrow-left"></i></a>
        </div>
        <h3 class="text-center" style="margin-left:150px" >Chat</h3>
        <div class="messaging">
            {{-- <div class="inbox_msg"> --}}
                <div class="inbox_people">
                </div>
                <div class="mesgs">
              
                   <div class="msg_history" style="border-style: solid;border-radius: 8px;padding: 5px;padding:10px;height: 650px;background-color: white;">
                        <div class="incoming_msg">
                                                    
                        </div>
                        {{-- @foreach($message as $pro)
                        <div class="outgoing_msg">
                            <div class="sent_msg" style="color:white !important">
                                
                              
                                <p class="text-muted" style="color: #ffffff!important;">{{$pro['message']}}</p>
                               
                     
                                <span class="time_date">{{$pro['date_formatted']}}</span>
                            </div>
                        </div>
                        @endforeach  --}}
                        @foreach($message as $pro)
                        @if($pro['user_id'] == $user_id ) 
                        @if(count(explode('%/',$pro['message'])) <= 1)

                        <div class="incoming_msg">
                         

                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <span class="time_date">{{$pro['first_name']}} {{$pro['last_name']}}</span>
                                   @if($pro['type'] == 'text' ) 
                                    <p  class="text-muted " style="color: #ffffff!important;">{{$pro['message']}}</p>
                                    @endif 

                                    @if($pro['type'] == 'photo' ) 
                                    <img src="{{"
                                    https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/chat/".$pro->message
                                }}" height="100px" width="120px"/>
                                    @endif 


                                    @if($pro['type'] == 'video' ) 
                                    <div id="video-player">
                                        <video width="150" height="100" controls>
                                            <source src="{{ "
                                                https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/chat/".$pro->message }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    @endif 

                                         {{-- <p  class="text-muted " >{{$pro['date_formatted']}}</p>     --}}
                                  
                                    <span class="time_date"> {{$pro['date_formatted']}}</span>
                                </div>
                            </div>
                        </div>
                        @else
                           <center> <p>--------------------------Start conversation for {{explode('%/',$pro->message)[1]}} service--------------------------</p></center>
                           <div class="incoming_msg">                       
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <span class="time_date">{{$pro['first_name']}} {{$pro['last_name']}}</span>
                                   @if($pro['type'] == 'text' ) 
                                    <p  class="text-muted " style="color: #ffffff!important;">{{explode('%/',$pro->message)[2]}}</p>
                                    @endif 

                                    @if($pro['type'] == 'photo' ) 
                                    <img src="{{"
                                    https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/chat/".$pro->message
                                }}" height="100px" width="120px"/>
                                    @endif 

                                    @if($pro['type'] == 'video' ) 
                                    <div id="video-player">
                                        <video width="150" height="100" controls>
                                            <source src="{{ "
                                                https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/chat/".$pro->message }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    @endif 
                                         {{-- <p  class="text-muted " >{{$pro['date_formatted']}}</p>     --}}
                                  
                                    <span class="time_date"> {{$pro['date_formatted']}}</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        @else
                        @if(count(explode('%/',$pro['message'])) <= 1)

                        <div class="outgoing_msg">
                            <div class="sent_msg" style="color:white !important">

                                <span class="time_date" style="text-align: right;">{{$pro['first_name']}} {{$pro['last_name']}}</span>
                                @if($pro['type'] == 'text' ) 
                                <p  class="text-muted" style="color: #ffffff!important;">{{$pro['message']}}</p>
                                @endif

                                @if($pro['type'] == 'photo' ) 
                                <img style="margin-left: 351px;" src="{{"
                                https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/chat/".$pro->message
                            }}" height="100px" width="120px"/>
                                @endif 

                                @if($pro['type'] == 'video' ) 
                                <div id="video-player" style="margin-left: 321px;">
                                    <video width="150" height="100" controls>
                                        <source src="{{ "
                                            https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/chat/".$pro->message }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                @endif 
                     
                                <span class="time_date" style="text-align: right;">{{$pro['date_formatted']}}</span>
                            </div>
                        </div>
                        @else
                        <center> <p>--------------------------Start conversation for {{explode('%/',$pro->message)[1]}} service--------------------------</p></center>
                     @endif
                        @endif

                     
                        @endforeach 
                     
                    </div>
                    
                </div>
            {{-- </div> --}}


            
        </div>
    </div>
    @endsection


