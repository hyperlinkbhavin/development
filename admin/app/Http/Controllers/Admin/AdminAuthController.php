<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Rules\MatchOldPassword;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables; 
use Error;
use DB;

class AdminAuthController extends Controller
{
    public function getLogin(){

        return view('adminlogin.login');
    }
  
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // dd($request->input());   
        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password'),'is_delete' => '0'])){
            $user = auth()->guard('admin')->check();
            $id = auth()->guard('admin')->user()->id;
            // $pass = auth()->guard('admin')->user()->password;
            // dd($user);
            if($user){
                $request->session()->put('user', $request->input('email'));
                $request->session()->put('admin_id', $id);
                
            //    dd($request->session()->get('user'));
            // echo $request->session()->get('user');
            // die;
        //  echo $request->session()->get('my_name');
            // );
                return redirect()->route('dashboard')->with('success','You are Logged in sucessfully.');
            }else {
                return back()->with('error','Oops! invalid email or password.');
            }

        }else {
            return back()->with('error','Oops! invalid email or password.');
        }
    }
 
    public function Logout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        // return redirect(route('adminLogin'));
    }

    public function profile_detail(Request $request){
        $data = Admin::find(session()->get('admin_id'));
        return view('adminlogin.adminprofile',['user'=>$data]);
    }

    public function change_password(Request $id){
        $data = Admin::find(base64_decode($id));
        // $response['error'] = 0;
        return view('ChangePassword.change_password');
    }

    public function update_password(Request $request)
    {
        // dd($request);
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' =>['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $current_user =  auth()->guard('admin')->user();
        // dd( $current_user);
        if(Hash::check($request->current_password, $current_user->password)){
            $data = Admin::find(session()->get('admin_id'));
            $data->password =  Hash::make($request->new_password);
            // dd($data);
            $data->update();
          
            return redirect()->route('adminLogin')->with('success','Your password chanaged sucessfully.');;
        }else{
            // $response['message'] = 'Please Enter Valid Current Password';
            // $response['error'] = 1;
            
            return view('ChangePassword.change_password');
        }
        
    }

    public function profile(Request $request)
    {
     
        $email = auth()->guard('admin')->user()->email;
        // dd($email);
        $db = Admin::select('id','email')
        ->where('email',$email)
        ->get();
        // dd($db);
                  
        if ($request->ajax()) {
            $datatable = DataTables::of($db)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '';
                $btn.= '<a href="' . route('profile_edit', base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>&nbsp;';

                // $btn.= '<a href="' . route('view_user_data', base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                // $btn.= '<a href="' . route('video_delete', base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>&nbsp;';
     
                return $btn;
            })->rawColumns(['action'])->make(true);
            return $datatable;
        } else {
            return view('adminlogin.profile',compact('db'));
        }
    }

    public function profile_edit(Request $request,$id){
        $data = Admin::find(base64_decode($id));
        return view('adminlogin.profileedit',['user'=> $data]);
    }

    public function profile_update(Request $request){
        // dd($request->id);
    $addUser = Admin::find($request->id);
    // dd($addUser);
    $addUser->email = $request->email;

    // $addUser->updatedate = date('Y-m-d h:i:s');
    $addUser->update();
    // $about_us = Pages::where('type','about_us')->first();
    return redirect()->route('adminLogin')->with('success', 'Your email changed successfully');
    // return redirect()->route('profile')->with('success', 'FAQ Updated Successfully');
}

}
