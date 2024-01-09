<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Rules\MatchOldPassword;
use App\Models\Admin;
use App\Models\Country;
use App\Models\AdminMenu;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Error;
use Mail;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Mockery\Undefined;

class SubAdminControllr extends Controller
{
    function view_page()
    {
        $code = Country::select('phonecode')->get();

        return view('CreateSubAdmin.createsubadmin', ['code' => $code]);
    }

    public function view_admin_list(Request $request)
    {
        $db = Admin::select(DB::raw('CONCAT(country_code," ",phone) AS mobile'), 'id', 'name', 'email', 'country_code', 'phone', 'is_active')
            ->where('role', 'A')
            ->where('is_delete', '0')
            ->get();
        //  dd($db);                 

        if ($request->ajax()) {
            $datatable = DataTables::of($db)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    // $btn.= '<a href="' . route('view_user_data', base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                    // $btn.= '<a href="' . route('video_delete', base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>&nbsp;';


                    $btn .= '<a href="' . route('permissions', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-lock-outline "></i></a>&nbsp;';

                    $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost(' . $row->id . ')"><i class="zmdi zmdi-delete "></button>';

                    return $btn;
                })->addColumn('status', function ($row) {
                    $btn1 = '';
                    if ($row->is_active == 1) {

                        $btn1 .= '<button data-rowid="' . $row->id . '" class="btn btn-raised bg-green waves-effect" onclick="statusChanged(' . $row->id . ', 0)"> Active </button>';
                    } else {
                        $btn1 .= '<button data-rowid="' . $row->id . '" class="btn  btn-raised btn-danger waves-effect" onclick="statusChanged(' . $row->id . ', 1)"> Inactive </button>';
                    }
                    return $btn1;
                })->rawColumns(['action', 'status'])->make(true);
            return $datatable;
        } else {
            return view('CreateSubAdmin.subadminlist', compact('db'));
        }
    }

    public function subadmin_Status(Request $request)
    {

        $status = Admin::find($request->id);
        $status->is_active = $request->action;
        $status->update();

        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }
    public function subadmin_delete(Request $request)
    {
        // echo"<pre>";print_r($id);die;
        Admin::where('id', $request->id)
            ->update([
                // 'password' => $new_password,
                'is_delete' => '1'
            ]);
    }

    function add_sub_admin(Request $req)
    {

        // $db= Admin::select('email')->where('is_delete','1')->get();
        // dd($db);
        // dd($db['email']);

        // if()
        // dd($req->input('email'));
        $db = Admin::where('email', '=', $req->input('email'))->where('is_delete', '0')->get();
        if (count($db) > 0) {
            // dd('if');

            $rules = array(
                'name' => 'required',
                'email' => 'required|email|unique:admins,email',
                // 'email' => ['required', Rule::unique('admins')->whereNull('is_delete')],
                // 'email'=> "required|email|unique:admins,email,{$this->user->id},id,is_delete,NULL",

                'phone' => 'required|string|max:16|unique:admins,phone',
            );

            $validator = Validator::make($req->all(), $rules);
            // dd($validator);
            if ($validator->fails()) {
                // dd($validator->fails());
                return back()->withErrors($validator->errors())->withInput();

                // return $validator->errors();
                //    return view('form',$validator->errors());
            } else {

                $password = Str::random(10);

                $data = new Admin;
                $data->name = $req->name;
                $data->email = $req->email;
                $data->password = Hash::make($password);
                $data->country_code = $req->country_code;
                $data->phone = $req->phone;
                // $data->country_code = $req->country_code;
                $data->role = 'A';
                // dd($data);  
                $data->save();

                Mail::send('email.admin', ['name' => $req->name, 'password' => $password], function ($message) use ($req) {
                    $message->to($req->email);
                    // dd($message);

                    $message->from('wardasapps@gmail.com', 'Bawabat');
                    $message->subject('Password');
                });

                // return redirect('userlist');
                return redirect()->route('view_admin_list')->with('success', 'Sub Admin Added Successfully');
                // dd($data);
            }
        } else {
            $rules = array(
                'name' => 'required',
                // 'email' => 'required|email|unique:admins,email',
                // 'email' => ['required', Rule::unique('admins')->whereNull('is_delete')],
                // 'email'=> "required|email|unique:admins,email,{$this->user->id},id,is_delete,NULL",

                'phone' => 'required|string|max:16|unique:admins,phone',
            );

            $validator = Validator::make($req->all(), $rules);
            // dd($validator);
            if ($validator->fails()) {
                // dd($validator->fails());
                return back()->withErrors($validator->errors())->withInput();

                // return $validator->errors();
                //    return view('form',$validator->errors());
            } else {

                $password = Str::random(10);

                $data = new Admin;
                $data->name = $req->name;
                $data->email = $req->email;
                $data->password = Hash::make($password);
                $data->country_code = $req->country_code;
                $data->phone = $req->phone;
                // $data->country_code = $req->country_code;
                $data->role = 'A';
                // dd($data);  
                $data->save();

                Mail::send('email.admin', ['name' => $req->name, 'password' => $password], function ($message) use ($req) {
                    $message->to($req->email);
                    // dd($message);

                    $message->from('wardasapps@gmail.com', 'Bawabat');
                    $message->subject('Password');
                });

                // return redirect('userlist');
                return redirect()->route('view_admin_list')->with('success', 'Sub Admin Added Successfully');
                // dd($data);
            }
        }
    }



    public function permissions($id)
    {
        // if (!has_permissions('admin.permissions')) {
        //         return redirect()->route('access_denied');
        //     }
        $user = Admin::where('id', '!=', 1)->find(base64_decode($id));
        // dd(base64_decode($id));

        if ($user) {
            $menus = AdminMenu::where('parent_id', 0)->where('status', 1)->get();
            // print_r($menus); die;

            return view('CreateSubAdmin..addperrmission', compact('menus', 'user'));
        } else {
            return redirect()->back()->with('common_error', 'Record not found');
        }
    }


    public function store_permissions(Request $request, $admin_id)
    {
        $subadmin = Admin::find($admin_id);

        // if (empty($subadmin)){
        //     return redirect()->back()->with('common_error','Record not found');
        // }


        $rules['permissions'] = 'required';

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // dd($validator->fails());
            return redirect()->back()->with('error', 'Please select minimum one field')->withInput();
        }

        $subadmin->permissions = json_encode($request->permissions);
        // dd($request->permissions);
        $subadmin->save();

        return redirect()->route('view_admin_list')->with('success', 'Permissions set successfully!')->withInput();
    }
}
