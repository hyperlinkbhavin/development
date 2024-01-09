<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Helpers\common;

use Yajra\DataTables\DataTables; 
// use App\\Http\Controllers\Admin\DataTables;
use DB;

class faqcontroller extends Controller
{
    public function faqlist(Request $request)
    {
        if (!common::has_permissions('admin.faqlist')) {
            return view('access_denied');
        } else {

        // die('hello');
        // $users = Demo::select('*')->paginate(4);
        // return view('admin/crud/list',compact('users'));
        // echo "<pre>";print_r($request);die;
        $db = Faq::where('is_active','1')->get();
        //  echo "<pre>";print_r($request->ajax());die;
        if ($request->ajax()) {
            // dd($request);
            $datatable = DataTables::of($db)
            ->addIndexColumn()
            ->addColumn('action',function(Faq $row){
                $btn = '';

                // $btn = '<a href="' . route('edit_faq', $row->id) . '" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser" style="background-color:#8f75d3;border:none;height:30px;width:30px"><i class="nav-icon fas fa-edit"></i></a>&nbsp;';
                if (common::has_permissions('admin.edit_faq')) {
                $btn.= '<a href="' . route('edit_faq', base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>&nbsp;';
                }

                if (common::has_permissions('admin.faq_view')) {
                $btn.= '<a href="' . route('faq_view',base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                }

                if (common::has_permissions('admin.delete_faq')) {
                $btn.= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost('.$row->id.')"><i class="zmdi zmdi-delete "></button>';
                }
           

                return $btn;


            })->rawColumns(['action'])->make(true);
            return $datatable;
        } else {
        $data = Faq::where('is_active','1')->get();

            return view('pages/faqs/faqlist',compact('db','data'));
        }
    }
    }

    public function add_faq(Request $request){
        if(!common::has_permissions('admin.add_faq')){
            return view('access_denied');
        }
        return view('pages.faqs.addfaq');
    }


    public function add_post_faq(Request $request){
        // dd($request);
        $addUser = new Faq();
        $addUser->question = $request->question ?? '';
        $addUser->answer = $request->answer ?? '';
        $addUser->is_active = '1';
        // $addUser->insertdate = strtotime("now");
        // $addUser->updatedate = date('Y-m-d h:i:s');
        // echo"<pre>";print_r(strtotime("now"));exit;
        $addUser->save();
        return redirect()->route('faqlist')->with('success', 'FAQ Added Successfully');
    }
    
        public function view_faq(Request $request,$id){
            $faq = Faq::find(base64_decode($id));
            return view('pages.faqs.faqview', ['user'=> $faq]);
        }

    public function edit_faq(Request $request,$id){
        $faq = Faq::find(base64_decode($id));
        return view('pages.faqs.editfaq',['user'=> $faq]);
    }

   
    public function update_post_faq(Request $request){
        // dd($request->id);
    $addUser = Faq::find($request->id);
    // dd($addUser);
    $addUser->question = $request->question;
    $addUser->answer = $request->answer;
    // $addUser->updatedate = date('Y-m-d h:i:s');
    $addUser->update();
    // $about_us = Pages::where('type','about_us')->first();
    return redirect()->route('faqlist')->with('success', 'FAQ Updated Successfully');
}

public function delete_faq(Request $request){
    // echo"<pre>";print_r($id);die;
    
    Faq::where('id',$request->id)
    ->update([
        // 'password' => $new_password,
        'is_delete' => '1',
        'is_active'=> '0'
     ]);
}

}
