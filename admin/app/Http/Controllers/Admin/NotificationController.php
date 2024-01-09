<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tbl_user;
use App\Models\Notification;
use App\Models\UserDeviceInfo;
use App\Models\serprodetail;
use App\Models\Country;
use App\Helpers\common;
use App\Models\serviceCategory;
use App\Models\Fevourite;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Error;
use DB;
use App\Traits\ConsumeExternalService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use Illuminate\Support\Facades\Session;
use App\Helpers\EncryptDecrypt;

class NotificationController extends Controller
{
    public function performRequest($method, $requestUri, $formParams = '', array $headers = [], bool $async = false): string
    {

        $client = new Client([
            'base_uri' => 'http://3.108.223.226:4450',
        ]);
        // $client->get('/', ['verify' => true]);
        // $header_name = env('HEADER_NAME');

        $headers['api-key'] = '8y00sHm9SRoWjMn+6IWhfQ==';
        // $headers['token'] = 'BtF7Uij2VNYZ98PsailFFh/mtVMvoATjRpVOIvHXjAs9I+WbeYd8/rRWS0D9/7in7GS6oBHSqtrlORzqXcKDCM+g0CRsznrB+STaIWSVNcE=';
        // $headers['Accept'] = 'text/plain';
        $headers['Content-Type'] = 'text/plain';
        // $headers['accept_language']=!empty(Session::get('USER_LANGUAGE_SESSION'))?Session::get('USER_LANGUAGE_SESSION')['abbr']:'en';
        // $headers['accept_language']='en';
        $response = "";
        if ($async) {
            $promise = $client->requestAsync($method, $requestUri, ['verify' => false, 'http_errors' => false, 'body' => $formParams, 'headers' => $headers]);
            $response = $promise->wait();
            $promise->then(
                function (ResponseInterface $res) {
                    $response = $res->getBody()->getContents();
                },
                function (RequestException $exception) {
                    $response = $exception->getMessage();
                }
            );
        } else {
            if ($method == 'GET') {
                // die('hello');
                // $response = $client->request($method,  $requestUri.'?'.http_build_query($formParams), ['verify' => false,'http_errors'=>false,'body' => $formParams, 'headers' => $headers]);
                $response = $client->request($method,  $requestUri, ['verify' => false, 'http_errors' => false, 'body' => $formParams, 'headers' => $headers]);
                $response = $response->getBody()->getContents();
            } else {
                if (empty($headers)) {
                    die('hello');
                }
                $response = $client->request($method, $requestUri, ['verify' => false, 'http_errors' => false, 'body' => $formParams, 'headers' => $headers]);
                // echo "<pre>hello";print_r($response->getBody()->getContents());die;

                // if($response->getStatusCode()== 401 || $response->getStatusCode()=='401')
                // {
                //  Session::forget('USER_LOGIN_SESSION');
                //  Session::save();
                //  return redirect()->route('home');
                // }  
                $response = $response->getBody()->getContents();
            }
        }
        return $response;
    }

    public function view_notification(Request $request)
    {
        //  DB::enableQueryLog();
        $users = Tbl_user::select('tbl_user.*')
            ->join('tbl_user_deviceinfo', 'tbl_user.id', 'tbl_user_deviceinfo.user_id')
            ->where('tbl_user.role', 'customer')
            ->whereNotNull('tbl_user_deviceinfo.device_token')
            ->where('tbl_user_deviceinfo.device_token', '!=', "0")
            ->get();

        $code = Tbl_user::select('tbl_user.country_code', 'tbl_country.*')
            ->join('tbl_country', 'tbl_user.country_code', 'tbl_country.phonecode')
            ->where('tbl_user.role', 'customer')
            ->groupBy('tbl_country.id')
            ->get();
        // dd($code->country_code);

        $city = Tbl_user::select('city')
            ->where('role', 'customer')
            ->groupBy('city')
            ->get();


        $category = serviceCategory::where('is_active', '1')->where('is_delete', '0')->get();
        // $city = Tbl_user::select('tbl_user.country_code', 'tbl_country.*','tbl_cities.name as city_name')
        //     ->join('tbl_country', 'tbl_user.country_code', 'tbl_country.phonecode')
        //     ->join('tbl_cities', 'tbl_country.id', 'tbl_cities.country_id')
        //     ->where('tbl_user.role', 'customer')
        //     ->groupBy('tbl_cities.id')
        //     ->get();
        // dd($city);

        // DB::enableQueryLog();
        $provider = Tbl_user::select('tbl_user.*')
            ->join('tbl_user_deviceinfo', 'tbl_user.id', 'tbl_user_deviceinfo.user_id')
            ->where('role', 'provider')
            ->whereNotNull('tbl_user_deviceinfo.device_token')
            ->where('tbl_user_deviceinfo.device_token', '!=', "0")
            ->get();
            // dd($provider);
        // dd(DB::getQueryLog());

        $proviser_code = Tbl_user::select('tbl_user.country_code', 'tbl_country.*')
            ->join('tbl_country', 'tbl_user.country_code', 'tbl_country.phonecode')
            ->where('tbl_user.role', 'provider')
            ->groupBy('tbl_country.id')
            ->get();

        $provider_city = Tbl_user::select('city')
            ->where('role', 'provider')
            ->groupBy('city')
            ->get();

        $service = serprodetail::select('service_name')
            ->groupBy('service_name')
            ->get();

        $data = DB::table('tbl_notification')
            ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
            ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title')
            ->where('tbl_notification.sender_id', '0')
            ->get();

        return view('pages.notificationview', compact(['users', 'code', 'city', 'provider', 'data', 'service', 'proviser_code', 'provider_city', 'category']));
    }


    public function get_data(Request $request)
    {
        // DB::enableQueryLog();
        $user = '';
        // dd($request->input());
        $whereData = array(array('tbl_user.role', 'customer'));
        if (($request->input('name') != '0')) {
            array_push($whereData, array('cat.name', $request->input('name')));
        }
        if (($request->input('country_code') != '0')) {
            array_push($whereData, array('tbl_user.country_code', $request->input('country_code')));
        }
        if (($request->input('city') != '0')) {
            array_push($whereData, array('tbl_user.city', $request->input('city')));
        }

        if (count($whereData) > 1) {
            $user = Tbl_user::select('tbl_user.*')
                ->leftJoin('tbl_fevourite', 'tbl_user.id', 'tbl_fevourite.customer_id')

                ->leftJoin('tbl_provider_service as ps', 'tbl_fevourite.service_id', 'ps.id')
                ->leftJoin('tbl_service_category as cat', 'ps.category_id', 'cat.id')
                // ->Join('tbl_user as u', 'tbl_fevourite.customer_id', 'u.id')

                ->where($whereData)

                ->groupBy('tbl_user.id')
                ->get();
            $cityWhere = array(array('role', 'customer'));

            if ($request->input('country_code') != '0') {
                array_push($cityWhere, array('country_code', $request->input('country_code')));
            }

            $city = Tbl_user::select('city')->where($cityWhere)->groupBy('city')->get();
            // dd($user);s
            // dd(DB::getQueryLog());
            $response = ['user' => $user, 'city' => $city];
            return $response;
        } else {
            $user = Tbl_user::select('tbl_user.*')

                ->where($whereData)

                ->groupBy('tbl_user.id')
                ->get();
            $cityWhere = array(array('role', 'customer'));
            if ($request->input('country_code') != '0') {
                array_push($cityWhere, array('country_code', $request->input('country_code')));
            }

            $city = Tbl_user::select('city')->where($cityWhere)->groupBy('city')->get();

            // dd($user);
            // dd(DB::getQueryLog());
            $response = ['user' => $user, 'city' => $city];
            return $response;
        }
    }

    public function get_provider_data(Request $request)
    {

        // DB::enableQueryLog();
        $user = '';
        // dd($request->input());
        $whereData = array(array('tbl_user.role', 'provider'));
        if (($request->input('service_name') != '0')) {
            array_push($whereData, array('tbl_provider_service.service_name', $request->input('service_name')));
        }
        if (($request->input('country_code') != '0')) {
            array_push($whereData, array('tbl_user.country_code', $request->input('country_code')));
        }
        if (($request->input('city') != '0')) {
            array_push($whereData, array('tbl_user.city', $request->input('city')));
        }


        if (count($whereData) > 1) {
            $user = Tbl_user::select('tbl_user.*')
                ->leftJoin('tbl_provider_service', 'tbl_user.id', 'tbl_provider_service.provider_id')
                ->where($whereData)
                // ->where('', $request->input('service_name'))
                // ->where('tbl_user.country_code', $request->input('country_code'))
                // ->where('tbl_user.city', $request->input('city'))
                // ->where('tbl_user.role', 'provider')
                ->groupBy('tbl_user.id')
                ->get();

            $cityWhere = array(array('role', 'provider'));

            if ($request->input('country_code') != '0') {
                array_push($cityWhere, array('country_code', $request->input('country_code')));
            }

            $city = Tbl_user::select('city')->where($cityWhere)->groupBy('city')->get();
            // dd($user);
            // dd(DB::getQueryLog());
            $response = ['user' => $user, 'city' => $city];
            return $response;
        } else {
            $user = Tbl_user::select('tbl_user.*')

                ->where($whereData)
                // ->where('', $request->input('service_name'))
                // ->where('tbl_user.country_code', $request->input('country_code'))
                // ->where('tbl_user.city', $request->input('city'))
                // ->where('tbl_user.role', 'provider')
                ->groupBy('tbl_user.id')
                ->get();

            $cityWhere = array(array('role', 'provider'));

            if ($request->input('country_code') != '0') {
                array_push($cityWhere, array('country_code', $request->input('country_code')));
            }

            $city = Tbl_user::select('city')->where($cityWhere)->groupBy('city')->get();
            // dd($user);
            // dd(DB::getQueryLog());
            $response = ['user' => $user, 'city' => $city];
            return $response;
        }
    }


    public function store(Request $request)
    {
        // if (!common::has_permissions('admin.store')) {
        //     return view('send_n_d');
        // }
        if ($request->allUser) {
            // dd($request);
            $request->users_list = Tbl_user::where('role', $request->customer_type)->get(['id']);
            $ids = [];
            foreach ($request->users_list as $value) {
                array_push($ids, $value['id']);
            }
            $post_data = array(
                'push_params' => array(
                    'title' => 'Bawabat',
                    'body' => $request->notification_message,
                    'custom' => array(
                        'title' => 'Bawabat',
                        'body'  => $request->notification_message,
                        'tag'   => 'admin_notification',
                        'image' => 'https://sbs3bucket-1.s3.eu-west-2.amazonaws.com/user/logo.png',
                        'action_id' => 0,
                    )
                ),

                'sender_id' => 0,
                'sender_type' => 'admin',
                'message_type' => 'notification',
                'receiver_id' => implode(',', $ids),
                'role' => $request->customer_type
            );
            $response = $this->performRequest("POST", "/send_notification", json_encode($post_data));
            // dd($response);   
            $output = [];

            return redirect()->route('view_notification')->with('success', 'Notification sent successfully');
        } else {
            $post_data = array(
                'push_params' => array(
                    'title' => 'Bawabat',
                    'body' => $request->notification_message,
                    'custom' => array(
                        'title' => 'Bawabat',
                        'body'  => $request->notification_message,
                        'tag'   => 'admin_notification',
                        'image' => 'https://sbs3bucket-1.s3.eu-west-2.amazonaws.com/user/logo.png',
                        'action_id' => 0,
                    )
                ),

                'sender_id' => 0,
                'sender_type' => 'admin',
                'message_type' => 'notification',
                'receiver_id' => implode(',', $request->users_list),
                'role' => $request->customer_type
            );
            $response = $this->performRequest("POST", "/send_notification", (json_encode($post_data)));
            // dd($response);
            $output = [];

            return redirect()->route('view_notification')->with('success', 'Notification sent successfully');
        }
    }

    public function get_notification(Request $request)
    {

        $db = DB::table('tbl_notification')
            ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
            ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title',DB::raw('count(*) as notificationCount'), 'tbl_notification.id')
            ->where('tbl_notification.sender_id', '0')
            ->where('tbl_user.role','customer')
            ->groupBy('insert_datetime')
            ->get();
            // dd($db);        // }

        if ($request->ajax()) {
            $datatable = DataTables::of($db)
            ->addIndexColumn()
            ->addColumn('full_name', function ($row) {
                    // dd($row->notificationCount);
                    // dd($row);
                    if($row->notificationCount > 1){
                        $btn = '';
                        $btn = 'Group of users';
                        return $btn;
                    }else{
                        $btn = '';    
                        $btn = $row->first_name.' '.$row->last_name;
                        return $btn;
                    }
                  
                }) ->addColumn('action', function ($row) {
                    $btn1 = '';
                    // dd($row);
                    // if (common::has_permissions('admin.view_user_data')) {
                        $btn1 .= '<a href="' . route('view_customer_notification', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                    // }

                   
                    return $btn1;
                })->rawColumns(['full_name','action'])->make(true);


            return $datatable;
        } else {

            $data = DB::table('tbl_notification')
                ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
                ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title')
                ->where('tbl_notification.sender_id', '0')
                ->where('tbl_user.role','customer')
                ->get();

            //  dd($data);
            // dd(DB::getQueryLog());
            return view('pages.notificationview', compact('db', 'data'));
        }
    }


    public function view_customer_notification(Request $request, $id)
    {
        $data = Notification::find(base64_decode($id));

        return view('pages.notification_view',['data'=>$data]);
    }

    public function get_provider_notification(Request $request)
    {

        $db = DB::table('tbl_notification')
            ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
            ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title',DB::raw('count(*) as notificationCount'), 'tbl_notification.id')
            ->where('tbl_notification.sender_id', '0')
            ->where('tbl_user.role','provider')
            // ->where('tbl_notification.id', '2814')
            ->groupBy('insert_datetime')
            ->groupBy('message')
            ->get();
  
        if ($request->ajax()) {
            $datatable = DataTables::of($db)

            ->addColumn('full_name', function ($row) {
                // dd($row->notificationCount);
                // dd($row);
                if($row->notificationCount > 1){
                    $btn = '';
                    $btn = 'Group of providers';
                    return $btn;
                }else{
                    $btn = '';
                    $btn = $row->first_name.' '.$row->last_name;
                    return $btn;
                }
              
            }) ->addColumn('action', function ($row) {
                $btn1 = '';
                // dd($row);
                // if (common::has_permissions('admin.view_user_data')) {
                    $btn1 .= '<a href="' . route('view_provider_notification', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                // }

               
                return $btn1;
            })->rawColumns(['full_name','action'])->make(true);


            return $datatable;
        } else {

            $data = DB::table('tbl_notification')
                ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
                ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title')
                ->where('tbl_notification.sender_id', '0')
                ->where('tbl_user.role','provider')
                ->get();

            //  dd($data);
            // dd(DB::getQueryLog());
            return view('pages.notificationview', compact('db', 'data'));
        }
    }

    public function customer_notification_table(Request $request)
    {

        $db = DB::table('tbl_notification')
            ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
            ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title', 'tbl_notification.id')
            ->where('tbl_notification.sender_id', '0')
            ->where('tbl_user.role','customer')
            // ->where('tbl_notification.id', '2814')
            ->where('tbl_notification.insert_datetime',$request->insert_datetime)
            ->where('tbl_notification.message',$request->message)
            ->get();
            // dd($db);
        // }
        // dd($db);
        if ($request->ajax()) {
            $datatable = DataTables::of($db)

            ->addColumn('full_name', function ($row) {
                // dd($row->notificationCount);
                // dd($row);
               
                    $btn = '';
                    $btn = $row->first_name.' '.$row->last_name;
                    return $btn;
                
              
            })->rawColumns(['full_name'])->make(true);

            return $datatable;
        } else {

            $data = DB::table('tbl_notification')
                ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
                ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title')
                ->where('tbl_notification.sender_id', '0')
                ->where('tbl_user.role','customer')
                ->get();

            //  dd($data);
            // dd(DB::getQueryLog());
            return view('pages.notification_view', compact('db', 'data'));
        }
    }

    public function view_provider_notification(Request $request, $id)
    {
        $data = Notification::find(base64_decode($id));

        return view('pages.provider_notification',['data'=>$data]);
    }
    
    public function provider_notification_table(Request $request)
    {

        $db = DB::table('tbl_notification')
            ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
            ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title', 'tbl_notification.id')
            ->where('tbl_notification.sender_id', '0')
            ->where('tbl_user.role','provider')
            // ->where('tbl_notification.id', '2814')
            ->where('tbl_notification.insert_datetime',$request->insert_datetime)
            ->where('tbl_notification.message',$request->message)
            ->get();
            // dd($db);
        // }
        // dd($db);
        if ($request->ajax()) {
            $datatable = DataTables::of($db)

            ->addColumn('full_name', function ($row) {
                // dd($row->notificationCount);
                // dd($row);
               
                    $btn = '';
                    $btn = $row->first_name.' '.$row->last_name;
                    return $btn;
                
              
            })->rawColumns(['full_name'])->make(true);

            return $datatable;
        } else {

            $data = DB::table('tbl_notification')
                ->join('tbl_user', 'tbl_notification.receiver_id', '=', 'tbl_user.id')
                ->select(DB::raw('DATE_FORMAT("tbl_notification.insert_datetime", "%d %M, %Y %I:%i %p")'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_notification.id', 'tbl_notification.insert_datetime', 'tbl_notification.message', 'tbl_notification.title')
                ->where('tbl_notification.sender_id', '0')
                ->where('tbl_user.role','provider')
                ->get();

            //  dd($data);
            // dd(DB::getQueryLog());
            return view('pages.provider_notification', compact('db', 'data'));
        }
    }
}
