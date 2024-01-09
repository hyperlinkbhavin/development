<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tbl_user;
use App\Models\TblDeviceInfo;
use App\Models\serprodetail;
use App\Models\SerBusiness;
use App\Models\ServiceTime;
use App\Models\ServiceImage;
use App\Models\Country;

use App\Helpers\common;

use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Error;
use DB;

class ServiceProviderController extends Controller
{


    public function service_provider(Request $request)
    {

        if (!common::has_permissions('admin.service_provider')) {
            return view('access_denied');
        } else {
            $code = Tbl_user::select('tbl_user.country_code', 'tbl_country.*')
            ->join('tbl_country', 'tbl_user.country_code', 'tbl_country.phonecode')
            ->where('tbl_user.role', 'provider')
            ->groupBy('tbl_country.id')
            ->get();
        // dd($code->country_code);

           $city = Tbl_user::select('city')
            ->where('role', 'provider')
            ->groupBy('city')
            ->get();

            $provider = Tbl_user::where('role', 'provider')->where('is_delete', '0')->get();

            $delete = Tbl_user::where('role', 'provider')->where('is_delete', '1')->get();
            // DB::enableQueryLog(); 
            $data = Tbl_user::select(DB::raw('CONCAT(tbl_user.country_code," ",tbl_user.mobile) AS phone'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.id', 'tbl_user.social_id', 'tbl_user.profile_image', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_user.email', 'tbl_user.mobile', 'tbl_user.country_code', 'tbl_user.city', 'tbl_user.is_active', 'tbl_user.is_approved', 'tbl_user.total_avg_rating', 'tbl_user.insert_date', 'tbl_user.is_delete', 'tbl_provider_business.business_name', 'tbl_user.last_login')
                ->leftjoin('tbl_provider_business', 'tbl_user.id', '=', 'tbl_provider_business.provider_id')
                ->where('tbl_user.role', 'provider')
                ->get();
            // Enable query log

            // Your Eloquent query executed by using get()

            // dd(DB::getQueryLog()); 

            // dd($data);
            return view('serviceProvider.serviceprovider', compact('data','code', 'city','provider', 'delete'));
            // return view('Services.servicelist', compact('data'));
        }
    }

    public function service_provider_filter(Request $request)
    {
        // print_r(common::has_permissions('admin.service_provider')); die;

        if (!common::has_permissions('admin.service_provider')) {
            return view('access_denied');
        } else {

            $provider = Tbl_user::where('role', 'provider')->where('is_delete', '0')->get();

            $delete = Tbl_user::where('role', 'provider')->where('is_delete', '1')->get();


            // $db = Tbl_user::select(DB::raw('CONCAT(tbl_user.country_code," ",tbl_user.mobile) AS phone'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.id', 'tbl_user.social_id', 'tbl_user.profile_image', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_user.email', 'tbl_user.mobile', 'tbl_user.country_code', 'tbl_user.city', 'tbl_user.is_active', 'tbl_user.is_approved', 'tbl_user.total_avg_rating', 'tbl_user.insert_date', 'tbl_user.is_delete','tbl_provider_business.business_name')
            // ->join('tbl_provider_business','tbl_user','tbl_provider_business.provider_id')
            //     ->where('tbl_user.role', 'provider')
            //     ->get();
            // if($request->status == 'blocked'){
            //     $col = 'tbl_user.is_active';
            //     $status = 0;
            // }else if($request->status == 'approved'){
            //     $col = 'tbl_user.is_approve';
            //     $status = 1;
            // }else if($request->status == 'pending'){
            //     $col = 'tbl_user.is_approve';
            //     $status = 0;
            // }else{
            //     $col = 'tbl_user.is_active';
            //     $status = 1;
            // }
            // $db = Tbl_user::select(DB::raw('CONCAT(tbl_user.country_code," ",tbl_user.mobile) AS phone'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.id', 'tbl_user.social_id', 'tbl_user.profile_image', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_user.email', 'tbl_user.mobile', 'tbl_user.country_code', 'tbl_user.city', 'tbl_user.is_active', 'tbl_user.is_approved', 'tbl_user.total_avg_rating', 'tbl_user.insert_date', 'tbl_user.is_delete', 'tbl_provider_business.business_name', 'tbl_user.last_login')
            //     ->leftjoin('tbl_provider_business', 'tbl_user.id', '=', 'tbl_provider_business.provider_id')
            //     ->where('tbl_user.role', 'provider')
            //     ->where($col,$status)
            //     ->get();
            // dd($request->status)
            // DB::enableQueryLog(); 

       
            $whereData = array(array('tbl_user.role', 'provider'));

            if($request->filter_status == 'blocked') {
                $col = 'tbl_user.is_active';
                $status = 0;
                array_push($whereData, array($col, $status));

            } else if($request->filter_status == 'approved') {
                $col = 'tbl_user.is_approved';
                $status = 1;
                array_push($whereData, array($col, $status));

            } else if($request->filter_status == 'pending') {
                $col = 'tbl_user.is_approved';
                $status = 0;
                array_push($whereData, array($col, $status));

            }

           
        if (($request->country != 0)) {
            array_push($whereData, array('tbl_user.country_code', $request->country));
            // array_push($whereData, array('tbl_user.country', $country_arr[1]));

        }
        // dd($request->city);
        if (($request->city != '0')) {
            array_push($whereData, array('tbl_user.city', $request->city));
        }
            
            $db = Tbl_user::select(DB::raw('CONCAT(tbl_user.country_code," ",tbl_user.mobile) AS phone'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.id', 'tbl_user.social_id', 'tbl_user.profile_image', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_user.email', 'tbl_user.mobile', 'tbl_user.country_code', 'tbl_user.city', 'tbl_user.is_active', 'tbl_user.is_approved', 'tbl_user.total_avg_rating', 'tbl_user.insert_date', 'tbl_user.is_delete', 'tbl_provider_business.business_name', 'tbl_user.last_login')
                ->leftJoin('tbl_provider_business', 'tbl_user.id', '=', 'tbl_provider_business.provider_id')
                // ->where('tbl_user.role', 'provider')
                // ->where($col, $status)
                ->where($whereData)
                ->get();
            
                // dd(DB::getQueryLog()); 

            // ->where('is_delete','0');
            // dd($db);

            if ($request->ajax()) {
                // print_r($request->filter_status);
                $datatable = DataTables::of($db)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '';

                        if (common::has_permissions('admin.provider_edit')) {
                            $btn .= '<a href="' . route('provider_edit', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>&nbsp;';
                        }

                        if (common::has_permissions('admin.view_provider_data')) {
                            $btn .= '<a href="' . route('view_provider_data', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                        }

                        if (common::has_permissions('admin.provider_Status')) {
                            if ($row->is_active == 1 && $row->is_delete == 0) {
                                $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="statusChanged(' . $row->id . ', 0)"> <i class="zmdi zmdi-lock-open"></i>
                    </button>&nbsp&nbsp';
                            } else if ($row->is_delete == 1) {
                                $btn .= '';
                            } else {
                                $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="statusChanged(' . $row->id . ', 1)"> <i class="zmdi zmdi-lock"></i>
                    </button> &nbsp&nbsp';
                            }
                        }
                        if (common::has_permissions('admin.provider_delete')) {
                            if ($row->is_delete == 0) {
                                $btn .= '<button data-rowid="' . $row->id . '" style="width: 70px;" class="btn btn-raised bg-green waves-effect" onclick="statusChangedd(' . $row->id . ', 1)"> Delete </button>';
                            } else {
                                $btn .= '<button data-rowid="' . $row->id . '" style="width: 70px;" class="btn  btn-raised btn-danger waves-effect" onclick="statusChangedd(' . $row->id . ', 0)"> Deleted </button>';
                            }
                        }
                        return $btn;
                    })->addColumn('profile_image', function ($row) {
                        $video = '';

                        // $video .= '<img width="470" height="255" src="https://hlink-bhavinp-s3.s3.amazonaws.com/capture/post/video_thumbnail/'.$row->video_thumbnail_file.'" >
                        //      </img>';
                        $video .= "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/user/" . $row->profile_image . "";


                        // $btn.= '<a data-rowid="' . $row->id . '" href="javascript:void(0)" onClick="deleteFaq('.$row->id.')" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>';

                        return $video;
                    })->addColumn('status', function (Tbl_user $row) {
                        // dd($row);
                        $btn1 = '';
                        // $btn1 .= '<a href="#!" class="btn waves-effect waves-teal">Approve</a>';
                        // $btn1 .= '<a href="#!" class="btn waves-effect waves-teal">Reject</a>';
                        if (common::has_permissions('admin.provider_Approve')) {
                            if ($row->is_approved == 0) {
                                $btn1 .= '<button data-rowid="' . $row->id . '" style="width: 70px;" class="btn waves-effect waves-teal" onclick="statusApprove(' . $row->id . ', 1)"> Approve </button>';

                                $btn1 .= '<button data-rowid="' . $row->id . '" style="width: 70px;" class="btn waves-effect waves-teal" onclick="statusApprove(' . $row->id . ', 2)"> Reject </button>';
                            } else if ($row->is_approved == 1) {
                                $btn1 .= '<a  href="javascript:void(0);" data-rowid="' . $row->id . '" style="width: 70px;" class="btn btn-raised bg-green waves-effect" > Approved </a>';
                                // <a href="javascript:;" onclick="change_status(20,true);" class="badge badge-green bg-green">Active</a>
                            } else if ($row->is_approved == 2) {
                                $btn1 .= '<a  href="javascript:void(0);" data-rowid="' . $row->id . '" onclick="statusReject(' . $row->id . ', 1)" style="width: 70px;" class="btn  btn-raised btn-danger waves-effect" > Rejected </a>';
                            }
                        }


                        // if($row->is_active == 1){
                        // $btn1 .= '<button data-rowid="' . $row->id . '" class="btn btn-raised bg-green waves-effect" onclick="statusChanged('.$row->id.', 0)"> Block </button>';

                        // } else {
                        // $btn1 .= '<button data-rowid="' . $row->id . '" class="btn  btn-raised btn-danger waves-effect" onclick="statusChanged('.$row->id.', 1)"> Unblock </button>';
                        // }
                        // dd($btn1);
                        return $btn1;
                    })->addColumn('provide_name', function (Tbl_user $row) {
                        // dd($row);
                        $btn2 = '';

                        $name = Tbl_user::select(DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'))
                            ->where('id', $row['id'])
                            ->get();

                        $btn2 .= '<a style="color:#444444" href="' . route('view_provider_data', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show">' . $name[0]['full_name'] . '</a>';



                        return $btn2;
                    })->addColumn('email', function (Tbl_user $row) {
                        // dd($row);
                        $btn3 = '';

                        // $name = Tbl_user::select('email')
                        //     ->where('id', $row['id'])
                        //     ->get();

                        $btn3 .= '<a style="color:#444444" href="mailto:' . $row['email'] . ' " >' . $row['email'] . ' </a></div>';

                        return $btn3;
                    })->rawColumns(['email', 'provide_name', 'action', 'status'])->make(true);
                return $datatable;
            } else {
                $data =  Tbl_user::select(DB::raw('CONCAT(tbl_user.country_code," ",tbl_user.mobile) AS phone'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.id', 'tbl_user.social_id', 'tbl_user.profile_image', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_user.email', 'tbl_user.mobile', 'tbl_user.country_code', 'tbl_user.city', 'tbl_user.is_active', 'tbl_user.is_approved', 'tbl_user.total_avg_rating', 'tbl_user.insert_date', 'tbl_user.is_delete', 'tbl_provider_business.business_name', 'tbl_user.last_login')
                    ->leftjoin('tbl_provider_business', 'tbl_user.id', '=', 'tbl_provider_business.provider_id')
                    ->where('tbl_user.role', 'provider')
                    ->get();

                return view('serviceProvider.serviceprovider', compact('db', 'data', 'provider', 'delete'));
            }
        }
    }

    public function provider_Status(Request $request)
    {
        $status = Tbl_user::find($request->id);

        $status->is_active = $request->action;
        $status->update();
        TblDeviceInfo::where('user_id', $request->id)
            ->update([
                'token' => ''
            ]);

        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }

    public function change_provider_status(Request $request)
    {

        $status = Tbl_user::find($request->id);

        $status->is_delete = $request->action;

        //    dd($status->is_delete);
        $status->update();
        TblDeviceInfo::where('user_id', $request->id)
            ->update([

                'token' => ''
            ]);


        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }

    public function provider_Approve(Request $request)
    {
        $status = Tbl_user::find($request->id);

        $status->is_approved = $request->action;
        $status->update();

        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }

    public function view_provider_data(Request $request, $id)
    {
        if (!common::has_permissions('admin.view_provider_data')) {
            return view('access_denied');
        }

        $data = Tbl_user::find(base64_decode($id));

        $business_name = DB::table('tbl_provider_business')
            ->where('provider_id', $data['id'])
            ->get();
        // dd($business_name[0]->business_name);
        $category = DB::table('tbl_provider_service')
            ->where('provider_id', $data['id'])
            ->groupBy('category_id')
            ->get();

        $service = DB::table('tbl_provider_service')
            ->where('provider_id', $data['id'])

            ->get();

        $ip = TblDeviceInfo::select('ip', 'device_type')
            ->where('user_id', $data['id'])
            ->get();


        $country = DB::table('tbl_user as u')
            ->join('tbl_country as c', 'u.country_iso', '=', 'c.sortname')
            ->select('u.country_code', 'u.country_iso', 'u.city', 'c.name as c_name')
            ->where('u.id', '=', $data['id'])
            ->first();


        $reels = DB::table('tbl_provider_story')
            // ->select(DB::raw('count(provider_id) as story'))
            ->where('provider_id', $data['id'])
            ->where('insert_date', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->where('is_delete', '0')
            ->get();

        // $reels = DB::()
        // dd($result);
        // $service = serprodetail::where('provider_id',(base64_decode($id)))->get();
        // dd($product);
        return view('serviceProvider.serviceproviderview', ['user' => $data, 'category' => $category, 'service' => $service, 'business_name' => $business_name, 'ip' => $ip, 'country' => $country, 'reels_count' => $reels]);
    }

    public function provider_list(Request $request)
    {
        // $data = Tbl_user::find(base64_decode($id));
        // dd($request->id);
        // SELECT tsc.name,tss.subcat_name FROM tbl_provider_service as tps
        // join tbl_service_category as tsc on tps.category_id = tsc.id 
        // join tbl_service_subcategory as tss on tps.sub_category_id = tss.id;

        $product = serprodetail::select('tbl_provider_service.id', 'tbl_provider_service.provider_id', 'tbl_provider_service.service_name', 'tbl_provider_service.description', 'tbl_provider_service.minimum_rate', 'tbl_provider_service.maximum_rate', 'tbl_service_category.name', 'tbl_service_subcategory.name as subcat_name')
            ->join('tbl_service_category', 'tbl_provider_service.category_id', 'tbl_service_category.id')
            ->join('tbl_service_subcategory', 'tbl_provider_service.sub_category_id', 'tbl_service_subcategory.id')
            ->where('tbl_provider_service.provider_id', $request->id)
            ->where('tbl_provider_service.is_delete', '0')
            ->get();

        // $product = serprodetail::select('id','provider_id','service_name','description','minimum_rate','maximum_rate','service_logo')
        // ->where('provider_id',$request->id)
        // ->get();
        // dd($product);
        // dd($request->id);
        if ($request->ajax()) {
            $datatable = DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('time', function (serprodetail $row) {
                    // dd($row);
                    $btn = '';
                    $btn .= '<a href="' . route('provider_time', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-time"></i>
                </a>&nbsp;';

                    // $btn .= '<a href="' . route('provider_images', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green btn_image"><i class="zmdi zmdi-collection-folder-image"></i></a>&nbsp;';

                    return $btn;
                })->addColumn('images', function (serprodetail $row) {
                    // dd($row);
                    $btn1 = '';
                    //     $btn .= '<a href="' . route('provider_time', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-time"></i>
                    // </a>&nbsp;';

                    $btn1 .= '<a href="' . route('provider_images', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green btn_image"><i class="zmdi zmdi-collection-folder-image"></i></a>&nbsp;';

                    return $btn1;
                })->rawColumns(['time', 'images'])->make(true);
            return $datatable;
        } else {
            return view('serviceProvider.serviceproviderview', compact('product'));
        }
    }

    public function provider_time(Request $request, $id)
    {
        if (!common::has_permissions('admin.provider_time')) {
            return view('access_denied');
        }
        // $data = ServiceTime::find(base64_decode($id));
        // dd(base64_decode($id));
        return view('serviceProvider.servicetime', ['user' => base64_decode($id)]);
    }

    public function provider_images(Request $request, $id)
    {
        // dd($id);
        if (!common::has_permissions('admin.provider_images')) {
            return view('access_denied');
        }
        $data = ServiceImage::select('image')
            ->where('service_id', base64_decode($id))
            ->get();
        // dd($data);
        return view('serviceProvider.serviceimages', ['user' => $data]);
    }

    public function provider_time_view(Request $request)
    {


        // dd($request->input());STR_TO_DATE(yourColumnName , '%l:%i %p');SELECT TIME_FORMAT("19:30:10", "%h %i %s %p");
        $data = ServiceTime::select('id', 'day', DB::raw('TIME_FORMAT(open_time,"%h:%i:%s %p")as time'), DB::raw('TIME_FORMAT(close_time,"%h:%i:%s %p")as end_time'), 'status')
            ->where('service_id', $request->id)
            ->get();
        // dd($data);
        // $service = serprodetail::where('provider_id',(base64_decode($id)))->get();
        // dd($request->id);    
        if ($request->ajax()) {
            $datatable = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('service_logo', function ($row) {
                    $video = '';

                    // $video .= '<img width="470" height="255" src="https://hlink-bhavinp-s3.s3.amazonaws.com/capture/post/video_thumbnail/'.$row->video_thumbnail_file.'" >
                    //      </img>';

                    $video .= "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/service/" . $row->service_logo . "";


                    // $btn.= '<a data-rowid="' . $row->id . '" href="javascript:void(0)" onClick="deleteFaq('.$row->id.')" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>';

                    return $video;
                })->rawColumns(['logo'])->make(true);
            return $datatable;
        } else {
            return view('serviceProvider.servicetime', compact('data'));
        }
    }

    function makeRediectionWebsite($website)
    {
        if (strstr($website, "http") == "") {
            return "https://" . $website;
        } else {
            return $website;
        }
    }

    public function provider_business_list(Request $request)
    {
        // dd($request->id);
        $data = SerBusiness::select(DB::raw('CONCAT(country_code," ",mobile) AS phone'), 'id', 'provider_id', 'logo', 'business_name', 'description', 'website', 'mobile', 'country_code', 'email', 'address', 'registration_number')
            ->where('provider_id', $request->id)
            ->get();
        // dd($data);
        if ($request->ajax()) {
            $datatable = DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (SerBusiness $row) {
                    // dd($row);
                    $btn = '';

                    if (common::has_permissions('admin.business_edit')) {
                        $btn .= '<a href="' . route('business_edit', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>&nbsp;';
                    }

                    return $btn;
                })->addColumn('logo', function ($row) {
                    $video = '';

                    // $video .= '<img width="470" height="255" src="https://hlink-bhavinp-s3.s3.amazonaws.com/capture/post/video_thumbnail/'.$row->video_thumbnail_file.'" >
                    //      </img>';
                    $video .= "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/business/" . $row->logo . "";


                    // $btn.= '<a data-rowid="' . $row->id . '" href="javascript:void(0)" onClick="deleteFaq('.$row->id.')" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>';

                    return $video;
                })->addColumn('link', function ($row) {
                    $links = '';

                    $bussiness_link = SerBusiness::select('website')
                        ->where('id', $row['id'])
                        ->get();
                    // dd($bussiness_link[0]);
                    //    dd($bussiness_link[0]->website);
                    $links .= '<a  href="' .  $this->makeRediectionWebsite($bussiness_link[0]['website'])  . '"    target="_blank" data-original-title="Show">' . $bussiness_link[0]['website'] . '</a>';


                    // $btn.= '<a data-rowid="' . $row->id . '" href="javascript:void(0)" onClick="deleteFaq('.$row->id.')" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>';

                    return $links;
                })->addColumn('email', function (SerBusiness $row) {
                    // dd($row);
                    $btn3 = '';

                    // $name = Tbl_user::select('email')
                    //     ->where('id', $row['id'])
                    //     ->get();

                    $btn3 .= '<a style="color:#444444" href="mailto:' . $row['email'] . ' " >' . $row['email'] . ' </a></div>';

                    return $btn3;
                })->rawColumns(['email', 'link', 'action', 'logo'])->make(true);
            return $datatable;
        } else {
            return view('serviceProvider.serviceproviderview', compact('data'));
        }
    }

    public function business_edit(Request $request, $id)
    {
        $data = SerBusiness::find(base64_decode($id));
        // dd($faq['image']);
        // dd($data);
        $code = Country::select('phonecode', 'sortname')->get();
        // dd($code);
        return view('serviceProvider.business_edit', ['user' => $data, 'code' => $code]);
    }

    public function update_business(Request $request)
    {
        // dd($request->id);

        $update_customer = SerBusiness::find($request->id);
        // dd($update_customer['provider_id']);
        $update_customer->website = $request->website;
        $update_customer->email = $request->email;
        $update_customer->country_code = $request->country_code;
        $update_customer->mobile = $request->mobile;
        $update_customer->registration_number = $request->registration_number;

        // $addUser->updatedate = date('Y-m-d h:i:s');
        $update_customer->update();

        return redirect()->route('view_provider_data', base64_encode($update_customer['provider_id']))->with('success', 'Bussiness details update successfully');
    }

    public function provider_delete(Request $request)
    {
        // echo"<pre>";print_r($id);die;
        Tbl_user::where('id', $request->id)
            ->update([
                // 'password' => $new_password,
                'is_delete' => '1'
            ]);
    }

    public function provider_edit(Request $request, $id)
    {
        $data = Tbl_user::find(base64_decode($id));
        // dd($faq['image']);
        $code = Country::select('phonecode', 'sortname')->get();
        return view('serviceProvider.provider_edit', ['user' => $data, 'code' => $code]);
    }

    public function update_provider(Request $request)
    {
        // dd($request->id);

        $update_customer = Tbl_user::find($request->id);

        $update_customer->email = $request->email;
        $update_customer->country_code = $request->country_code;
        $update_customer->mobile = $request->mobile;

        // $addUser->updatedate = date('Y-m-d h:i:s');
        $update_customer->update();

        return redirect()->route('service_provider')->with('success', 'User details update successfully');
    }
}
