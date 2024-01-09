<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function send_notification($device_token,$device_type,$data)
    {             
        // dd($device_token);
        $user_id = $data['receiver_id'];
        $SERVER_API_KEY = 'AAAAdzUZYwg:APA91bHEty1zeBcTTPrSlfXYINkHa9fZjeCv8HN8RoF-QD4-C5wfahOJx4-0YnBaly2QtEuGBsX2lNWROvWp8zMmtFjKQrpsfMj7m67pWzE_rxTmENUabcgzHZv8e90nnX16jWiAd9ws';
        // dd($SERVER_API_KEY);
        if($device_type == 'A'){
            $data = array(
                "registration_ids" => $device_token,
                // "notification" => [
                    "alert" =>[
                        "title" => 'Bawabat',
                        "body" => $data['message']
                    ],  
                    // "custom"=> [
                            "data"=>[
                                "title"=> "Bawabat",
                                "user_id"=> $data['receiver_id'],
                                "sender_id"=> $data['sender_id'],
                                "body"=> $data['message'],
                                "tag"=> $data['tag'],
                                "is_from_admin"=> 1,
                            ],
                            "priority"=>"high"
                        //]

                //]
            );

            // dd($data);
        }else if ($device_type == 'I'){
            $data = array(
                "registration_ids" => $device_token,
                'priority'=>'high',
                "notification" => [
                    //"alert" =>[
                        "title" => 'Bawabat',
                        "body" => $data['message'],
                  //  ],  
                    "custom"=> [
                            "data"=>[
                                "title"=> "Bawabat",
                                "user_id"=> $data['receiver_id'],
                                "sender_id"=> $data['sender_id'],
                                "message"=> $data['message'],
                                "tag"=> $data['tag'],
                                "is_from_admin"=> 1,
                            ]
                        ]
                            ],
                            "priority"=>"high"
            );
            // dd($data);
        }
        $dataString = json_encode($data);
        // dd($dataString);
        
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
        // dd($headers);     
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                 
        $response = curl_exec($ch);
        
        // dd($response);
        // echo "<b>user</b> - ".$user_id." <b>response</b> - ";print_r($response);echo "<b>device_token</b> - ";print_r($device_token);echo "</br></br>";
        //return back()->with('success', 'Notification send successfully.');
        return 1;

    }
}
