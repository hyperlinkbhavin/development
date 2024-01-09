<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reel;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Helpers\s3upload;
use App\Helpers\common;

// use App\Http\Controllers\DateTime;
// use App\Http\Controllers\Admin\DateTimeZone;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DateTime;
// use Storage;
use Error;
use DB;


class AdvertiseController extends Controller
{
    //     public function advertisement_list(Request $request)
    //     {

    // // dd($request);
    //          $db = Reel::all();
    //         // $db = Advertisement::select('id','advertisement_type', 'reel', 'image','description','duration','celebrity_name','service','is_active')
    //         // ->where('is_delete','0');
    //         // dd($db);

    //         if ($request->ajax()) {
    //             $datatable = DataTables::of($db)
    //             ->addIndexColumn()->make(true);
    //         //    dd($datatable);
    //             return $datatable;
    //         } else {
    //             return view('advertisment.advertisement',compact('db'));
    //         }
    //     }
    function makeRediectionWebsite($website){
		if(strstr($website,"http")==""){
			return "https://".$website;
		}else{
			return $website;
		}
	}

    public function advertisement_list(Request $request)
    {
        if (!common::has_permissions('admin.advertisement_list')) {
            return view('access_denied');
        } else {

            $db = Reel::where('is_delete', '0')->get();

            // dd($db);
            // dd($request->ajax());
            if ($request->ajax()) {
                // dd($request->ajax());
                $datatable = DataTables::of($db)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '';

                        if (common::has_permissions('admin.advertisement_edit')) {
                            $btn .= '<a href="' . route('advertisement_edit', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>&nbsp;';
                        }
                        if (common::has_permissions('admin.view_advertisements_data')) {
                            $btn .= '<a href="' . route('view_advertisements_data', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                        }
                        if (common::has_permissions('admin.advertisements_delete')) {
                            $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost(' . $row->id . ')"><i class="zmdi zmdi-delete "></button>';
                        }
                        return $btn;
                    })->addColumn('media', function ($row) {
                        $video = '';


                        $video .= "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/banner/" . $row->media . "";



                        return $video;
                    })->addColumn('status', function ($row) {
                        $btn1 = '';

                        if (common::has_permissions('admin.advertisement_Status')) {
                            if ($row->is_active == 1) {
                                $btn1 .= '<button data-rowid="' . $row->id . '" style="width:59px" class="btn btn-raised bg-green waves-effect" onclick="statusChanged(' . $row->id . ', 0)"> Active </button>';
                            } else {
                                $btn1 .= '<button data-rowid="' . $row->id . '" class="btn  btn-raised btn-danger waves-effect" onclick="statusChanged(' . $row->id . ', 1)"> Inactive </button>';
                            }
                        }
                        return $btn1;
                    })->addColumn('link', function ($row) {
                        $links = '';
    
                        $Ad_link = Reel::select('link')
                            ->where('id', $row['id'])
                            ->get();
                        // dd($bussiness_link[0]);
                        //    dd($bussiness_link[0]->website);
                        $links .= '<a  style = "word-break:break-all" href="' .  $this->makeRediectionWebsite($Ad_link[0]['link'])  . '"    target="_blank" data-original-title="Show">' . $Ad_link[0]['link'] . '</a>';
    
                       
                        // $btn.= '<a data-rowid="' . $row->id . '" href="javascript:void(0)" onClick="deleteFaq('.$row->id.')" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>';
    
                        return $links;
                    })->rawColumns(['link','action', 'status'])->make(true);
                return $datatable;
            } else {
                $data = Reel::where('is_delete', '0')->get();

                return view('advertisment.advertisement', compact('db', 'data'));
            }
        }
    }
    public function advertisement_Status(Request $request)
    {

        $status = Reel::find($request->id);

        $status->is_active = $request->action;
        $status->update();

        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }

    public function view_advertisements_data(Request $request, $id)
    {
        $data = Reel::find(base64_decode($id));
        return view('advertisment.advertisementview', ['user' => $data]);
    }

    public function advertisement_edit(Request $request, $id)
    {
        $data = Reel::find(base64_decode($id));
        return view('advertisment.advertisementedit', ['user' => $data]);
    }

    public function update_advertisement(Request $request)
    {

        $rules = array(

            'media' => 'mimes:jpeg,png,jpg'
        );
        $validator = Validator::make($request->all(), $rules);
        // dd($validator->fails());
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        } else {

            $addUser = Reel::find($request->id);
            // dd($request->file('media'));
            if ($file1 = $request->file('media')) {

                $imageName = $file1->getClientOriginalName();
                $imageName = time() . str_replace(' ', '_', $imageName);
                $file = $_FILES['media']['tmp_name'];
                $path = env('AWS_BUCKET_FOLDER') . env('ADVERTISEMENT_IMAGE');
                $contents = s3upload::uploadImage($imageName, $file, $path);
                $image = $contents;

                $addUser->media_type = substr($_FILES['media']['type'], 0, 5) ?? '';
                $addUser->media = $image ?? '';
            }

            // dd($request->id);
            // dd($image);
            $addUser->description = $request->description ?? '';

            date_default_timezone_set("UTC");
            $addUser->start_date = date('Y-m-d H:i:s', strtotime($request->start_date . "Asia/Kolkata")) ?? '';
            if ($request->end_date) {
                $addUser->end_date = date('Y-m-d H:i:s', strtotime($request->end_date . "Asia/Kolkata"));
            } else {
                $addUser->end_date = null;
            }
            $addUser->link = $request->link ?? '';
            $addUser->name = $request->name ?? '';
            $addUser->is_active = '1';
            $addUser->update();

            return redirect()->route('advertisement_list')->with('success', 'Advertise updated Successfully');
        }
    }

    public function advertisements_delete(Request $request)
    {
        // echo"<pre>";print_r($id);die;

        reel::where('id', $request->id)
            ->update([
                // 'password' => $new_password,
                'is_delete' => '1'
            ]);
    }

    public function add_advertisements(Request $request)
    {
        if (!common::has_permissions('admin.add_advertisements')) {
            return view('access_denied');
        }

        $users = reel::get();
        // dd($users);
        return view('advertisment.advertisementadd', compact('users'));
    }

    public function add_data(Request $request)
    {
        // dd($request->file('media'));
        // dd(explode(";base64,", $request->input('media')));

    

        $rules = array(

            'media' => 'required|mimes:jpeg,png,jpg'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        } else {

            // dd($_FILES['media']);
            $image = $request->file('media');
            $imageName = $image->getClientOriginalName();
            // dd($imageName);
            // $imageName = time() . str_replace(' ', '_', $imageName);
            $file = $_FILES['media']['tmp_name'];
            // dd($file);
            $path = env('AWS_BUCKET_FOLDER') . env('ADVERTISEMENT_IMAGE');
            $contents = s3upload::uploadImage($imageName, $file, $path);
            // dd($contents);
            $images = $contents;

            $addUser = new reel();
            // $addUser->id = $request->id;
            // $addUser->advertisement_type = $request->advertisement_type ?? '';
            $addUser->media_type = substr($_FILES['media']['type'], 0, 5) ?? '';
            // $addUser->media = $_FILES['media']['name']?? '';
            $addUser->media = $images ?? '';
            $addUser->description = $request->description ?? '';


            // $the_date = strtotime("2010-01-19 00:00:00");
            // echo(date_default_timezone_get() . "<br />");
            // echo(date("Y-d-mTG:i:sz",$the_date) . "<br />");
            // echo(date_default_timezone_set("UTC") . "<br />");
            // echo(date("Y-d-mTG:i:sz", $the_date) . "<br />");


            date_default_timezone_set("UTC");
            // $startdate = date('Y-m-d H:i:s',strtotime($request->start_date." Asia/Kolkata"));
            // dd($startdate);
            $addUser->start_date = date('Y-m-d H:i:s', strtotime($request->start_date . "Asia/Kolkata")) ?? '';

            if ($request->end_date) {
                $addUser->end_date = date('Y-m-d H:i:s', strtotime($request->end_date . "Asia/Kolkata"));
            } else {
                $addUser->end_date = null;
            }

            // $addUser->end_date = date('Y-m-d H:i:s',strtotime($request->end_date."Asia/Kolkata")) ?? '';
            $addUser->link = $request->link ?? '';
            $addUser->name = $request->name ?? '';

            $addUser->is_active = '1';
            // $addUser->insertdate = strtotime("now");
            // $addUser->updatedate = date('Y-m-d h:i:s');
            // echo"<pre>";print_r(strtotime("now"));exit;
            // dd($addUser);       
            $addUser->save();
            return redirect()->route('advertisement_list')->with('success', 'Advertisement Added Successfully');
        }
    }
}
