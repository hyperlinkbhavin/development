<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; 
use Carbon\Carbon; 
use App\Models\Tbl_user; 
use App\Models\Admin;
use App\Models\Forgotpassword;
use Illuminate\Support\Facades\Validator;

use Mail; 
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function view(Request $request){
        
        return view('ForgotPassword.view');
    }
    
  public function newUser(Request $request){
        
      return view('ForgotPassword.new_user');
  }

  public function addUserData(Request $request){
        
    $addUser = new Tbl_user();
    $addUser->first_name = $request->first_name ?? '';
    $addUser->last_name = $request->last_name ?? '';
    $addUser->email = $request->email ?? '';
    $addUser->mobile = $request->phone ?? '';
    $addUser->city = $request->city ?? '';
    $addUser->country_code = $request->dial_code ?? '';
    $addUser->country_iso = $request->iso ?? '';
    $addUser->role = 'provider';
    $addUser->is_approved = "1";
    $addUser->password =  openssl_encrypt($request->password, 'AES-256-CBC', hash('sha256', 'y3FBUk4mXb87VP0qkh2eQPCEpmuk0Jfk'), 0, 'y3FBUk4mXb87VP0q')    ?? '';
    // $addUser->insertdate = strtotime("now");
    // $addUser->updatedate = date('Y-m-d h:i:s');
    // echo"<pre>";print_r(strtotime("now"));exit;
    // dd($addUser);
    // dd(openssl_decrypt($addUser->password, 'AES-256-CBC', hash('sha256', "y3FBUk4mXb87VP0qkh2eQPCEpmuk0Jfk"), 0, 'y3FBUk4mXb87VP0q'));
    $addUser->save();
  return view('ForgotPassword.thankyou');
  }


    public function submitForgetPasswordForm(Request $request)
      {
        // dd($request);
          $request->validate([
              'email' => 'required|email|exists:admins',
          ]);
  
          $token = Str::random(64);
  // dd($token);
          DB::table('admin_forgot_pass_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
            // dd(env('MAIL_FROM_ADDRESS'));
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);

              $message->from('wardasapps@gmail.com','Bawabat');
              $message->subject('Reset Password');
          });
  
          return redirect()->route('view')->with('success', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('ForgotPassword.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)

      {
        // dd('hello');
       
  // dd($request->input());
          $updatePassword = DB::table('admin_forgot_pass_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
//   dd($updatePassword);

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
//   dd($request->email);
        // DB::enableQueryLog();

          $user = Admin::where('email', $request->email)

                      ->update(['password' => Hash::make($request->password)]);
// dd(DB::getQueryLog());

//  dd($user);

          DB::table('admin_forgot_pass_resets')->where(['email'=> $request->email])->delete();
  
          return redirect()->route('adminLogin')->with('success','You password changed sucessfully.');
      }
}

