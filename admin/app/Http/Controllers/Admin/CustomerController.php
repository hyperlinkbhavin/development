<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tbl_user;
use App\Models\TblDeviceInfo;
use App\Models\Country;
use App\Helpers\common;
use Yajra\DataTables\DataTables;
use Error;
use DB;

class CustomerController extends Controller

{


    public function customers(Request $request)
    {

        if (!common::has_permissions('admin.customers')) {
            return view('access_denied');
        } else {


            $customer = Tbl_user::where('role', 'customer')->where('is_delete','0')->get();

            $delete = Tbl_user::where('role', 'customer')->where('is_delete','1')->get();


            $db = Tbl_user::select(DB::raw('CONCAT(tbl_user.country_code," ",tbl_user.mobile) AS phone'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.id', 'tbl_user.social_id', 'tbl_user.profile_image', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_user.email', 'tbl_user.mobile', 'tbl_user.country_code', 'tbl_user.city', 'tbl_user.is_active', 'tbl_user.is_delete', 'tbl_user.insert_date', 'tbl_user.last_login')
                ->where('tbl_user.role', 'customer')->get();
            // ->where('is_delete','0');
            // $data = Tbl_user::where('role','customer')->get();


            // dd($data);
            if ($request->ajax()) {
                $datatable = DataTables::of($db)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '';
                        if (common::has_permissions('admin.view_user_data')) {
                            $btn .= '<a href="' . route('view_user_data', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                        }

                        if (common::has_permissions('admin.customer_edit')) {

                            $btn .= '<a href="' . route('customer_edit', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>&nbsp;';
                        }

                        // if (common::has_permissions('admin.User_Status')) {
                        //     if ($row->is_active == 1 && $row->is_delete == 0) {
                        //         $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="statusChanged(' . $row->id . ', 0)"> <i class="zmdi zmdi-lock-open"></i></button>&nbsp&nbsp';
                        //     } else if ($row->is_delete == 1) {
                        //         $btn .= '';
                        //     } else {
                        //         $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="statusChanged(' . $row->id . ', 1)">  <i class="zmdi zmdi-lock"></button>&nbsp&nbsp';
                        //     }
                        // }

                        // if (common::has_permissions('admin.video_delete')) {
                        //     if ($row->is_delete == 0) {
                        //         $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised bg-green waves-effect" onclick="statusChangedd(' . $row->id . ', 1)"> Delete </button>';
                        //     } else {
                        //         $btn .= '<button data-rowid="' . $row->id . '" class="btn  btn-raised btn-danger waves-effect" onclick="statusChangedd(' . $row->id . ', 0)"> Deleted </button>';
                        //     }
                        // } 

                        if (common::has_permissions('admin.User_Status')) {
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
                        if (common::has_permissions('admin.video_delete')) {
                            if ($row->is_delete == 0) {
                                $btn .= '<button data-rowid="' . $row->id . '" style="width: 70px;" class="btn btn-raised bg-green waves-effect" onclick="statusChangedd(' . $row->id . ', 1)"> Delete </button>';
                            } else {
                                $btn .= '<button data-rowid="' . $row->id . '" style="width: 70px;" class="btn  btn-raised btn-danger waves-effect" onclick="statusChangedd(' . $row->id . ', 0)"> Deleted </button>';
                            }
                        }
                        // $btn.= '<a href="' . route('video_delete', base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>&nbsp;';
                        // $btn.= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost('.$row->id.')"><i class="zmdi zmdi-delete "></button>';

                        return $btn;
                    })->addColumn('profile_image', function ($row) {
                        $video = '';

                        // $video .= '<img width="470" height="255" src="https://hlink-bhavinp-s3.s3.amazonaws.com/capture/post/video_thumbnail/'.$row->video_thumbnail_file.'" >
                        //      </img>';
                        $video .= "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/user/" . $row->profile_image . "";


                        // $btn.= '<a data-rowid="' . $row->id . '" href="javascript:void(0)" onClick="deleteFaq('.$row->id.')" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>';

                        return $video;
                    })->addColumn('coins', function (Tbl_user $row) {

                        // $coinTotal = DB::table('tbl_wallet')
                        //     ->where('user_id', $row['id'])
                        //     ->select(DB::raw('SUM(amount) as coin'))
                        //     ->get();
                        // dd($coinTotal);

                        $coinTotal = DB::table('tbl_wallet')
                            ->where('user_id',  $row['id'])
                            ->select(DB::raw('SUM(amount) as coin'))
                            ->first();

                        $coin = $coinTotal->coin;
                        $coinValue = (string) $coin;

                        // echo $coinValue;
                        return $coinValue;
                        // ->first();

                    })->addColumn('full_name', function (Tbl_user $row) {
                        // dd($row);
                        $btn2 = '';

                        $name = Tbl_user::select(DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'))
                            ->where('id', $row['id'])
                            ->get();

                        $btn2 .= '<a style="color:#444444" href="' . route('view_user_data', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show">' . $name[0]['full_name'] . '</a>';



                        return $btn2;
                    })->addColumn('email', function (Tbl_user $row) {
                        // dd($row);
                        $btn3 = '';

                        // $name = Tbl_user::select('email')
                        //     ->where('id', $row['id'])
                        //     ->get();

                        $btn3 .= '<a style="color:#444444" href="mailto:' . $row['email'] . ' " >' . $row['email'] . ' </a></div>';

                        return $btn3;
                    })->rawColumns(['full_name', 'email', 'action', 'status'])->make(true);
                return $datatable;
            } else {

                $data = Tbl_user::select(DB::raw('CONCAT(tbl_user.country_code," ",tbl_user.mobile) AS phone'), DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_user.id', 'tbl_user.social_id', 'tbl_user.profile_image', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_user.email', 'tbl_user.mobile', 'tbl_user.country_code', 'tbl_user.city', 'tbl_user.is_active', 'tbl_user.is_delete', 'tbl_user.insert_date', 'tbl_user.last_login')
                    ->where('tbl_user.role', 'customer')->get();

                return view('Customers.customers', compact('db', 'data', 'customer','delete'));
            }
        }
    }

    public function change_User_status(Request $request)
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

    public function change_block_status(Request $request)
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

    public function viewUserData(Request $request, $id)
    {
        if (!common::has_permissions('admin.view_user_data')) {
            return view('access_denied');
        }
        $data = Tbl_user::find(base64_decode($id));

        $coinTotal = DB::table('tbl_wallet')
            ->where('user_id',  $data['id'])
            ->select(DB::raw('SUM(amount) as coin'))
            ->first();

        $coin = $coinTotal->coin;
        $coinValue = (string) $coin;
        // dd($coinTotal);
        $ip = TblDeviceInfo::select('ip', 'device_type')
            ->where('user_id', $data['id'])
            ->get();
        // dd($ip[0]["ip"]);
        // echo $coinValue;

        $country = DB::table('tbl_user as u')
            ->join('tbl_country as c', 'u.country_iso', '=', 'c.sortname')
            ->select('u.country_code', 'u.country_iso', 'u.city', 'c.name as c_name')
            ->where('u.id', '=', $data['id'])
            ->first();
// dd($country);
        return view('Customers.customersview', ['user' => $data, 'coinValue' => $coinValue, 'ip' => $ip, 'country'=>$country]);
    }

    public function delete_customer(Request $request)
    {
        echo"<pre>";print_r($request->id);die;
        // $record = Tbl_user::find(base64_decode($request->id));
        // dd($record);
        if (!common::has_permissions('admin.video_delete')) {
            return view('access_denied');
        }
        Tbl_user::where('id', $request->id)
            ->update([
                // 'password' => $new_password,
                'is_delete' => '1'
            ]);
        // $record->is_delete = '1';
        // $record->is_active = '0';
        // $record->updatedate = date('Y-m-d h:i:s');
        // $record->update();
        // return redirect()->route('customers')->with('success', 'Record Deleted Successfully.');
        return ;
        // return response()->json(['code' => 1, 'success' => 'Record Deleted Successfully.']);


    }

    public function customer_edit(Request $request, $id)
    {
        $data = Tbl_user::find(base64_decode($id));
        // dd($faq['image']);
        $code = Country::select('phonecode','sortname')->get();

        return view('Customers.customer_edit', ['user' => $data, 'code' => $code]);
    }

    public function update_customer(Request $request)
    {
        // dd($request->id);

        $update_customer = Tbl_user::find($request->id);

        $update_customer->email = $request->email;
        $update_customer->country_code = $request->country_code;
        $update_customer->mobile = $request->mobile;

        // $addUser->updatedate = date('Y-m-d h:i:s');
        $update_customer->update();

        return redirect()->route('customers')->with('success', 'User details update successfully');
    }
}
