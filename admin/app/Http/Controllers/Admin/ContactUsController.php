<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Helpers\common;

use Yajra\DataTables\DataTables;
use Error;
use DB;

class ContactUsController extends Controller
{
    function contactus(Request $request)
    {
        // $data = formdata::all();

        if (!common::has_permissions('admin.contactus')) {
            return view('access_denied');
        } else {

            $db = Contact::select(DB::raw('CONCAT(first_name," ",last_name) AS full_name'),'id','email','subject','description','is_active','is_delete','insert_date');
            // dd($db);
            if ($request->ajax()) {
                $datatable = DataTables::of($db)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '';

                        if (common::has_permissions('admin.contactusview')) {
                            $btn .= '<a href="' . route('contactusview', base64_encode($row->id)) . '" data-toggle="tooltip" da   ~ta-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                        }

                        // $btn .= '<a href="' . route('contactus_mail_view', base64_encode($row->id)) . '" data-toggle="tooltip" da   ~ta-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-email"></i>
                        // </a>&nbsp;';

                        $btn .= '<a href="mailto:'.$row['email'].'?subject='.$row['subject'].'" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-email"></i></a></div>';

                        return $btn;
                    })->addColumn('status', function (Contact $row) {
                        // dd($row);

                        $btn1 = '';

                        if (common::has_permissions('admin.contactus_status')) {
                            if ($row->is_active == 1) {
                                $btn1 .= '<button data-rowid="' . $row->id . '" style="width: 54px;" class="btn btn-raised bg-green waves-effect" > New </button>';
                            } else if ($row->is_active == 0) {
                                $btn1 .= '<button data-rowid="' .  $row->id . '" style="width: 54px;" class="btn  btn-raised btn btn-warning waves-effect" "> Open </button>';
                            } else if ($row->is_active == 2) {
                                $btn1 .= '<button data-rowid="' .  $row->id . '" style="width: 54px;" class="btn  btn-raised btn-primary waves-effect" "> Closed </button>';
                            }
                            // dd($btn1);
                        }
                        return $btn1;
                    })->rawColumns(['action', 'status'])->make(true);
                return $datatable;
            } else {
                $data = Contact::all();
                return view('pages.contactus', compact('db', 'data'));
            }
        }
    }

    public function closed_status(Request $request)
    {

        Contact::where('id', $request->id)

            ->update([
                // 'password' => $new_password,
                'is_active' => '2'
            ]);
        //     $status = Contact::where('id',base64_decode($request->id));
        // //  dd($status);
        //     $status->is_active = '2';
        //     // dd($status->is_active);
        //     $status->update();

        return redirect()->route('contactus')->with('success', 'Category Added Successfully');
    }


    public function contactus_status(Request $request)
    {

        $status = Contact::find($request->id);
        //  dd($status);
        $status->is_active = $request->action;
        // dd($status->is_active);
        $status->update();

        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }

    function contactusview($id)
    {
        $data = Contact::find(base64_decode($id));


        Contact::where('is_active', '1')->where('id', base64_decode($id))
            ->update([
                // 'password' => $new_password,
                'is_active' => '0'
            ]);
        // $product = Tbl_product::where('user_id',(base64_decode($id)))->get(['p_name']);
        return view('pages.contactusview', ['user' => $data]);
    }

    function contactus_mail_view($id)
    {
        $data = Contact::find(base64_decode($id));


        Contact::where('is_active', '1')->where('id', base64_decode($id))->get();

        // $product = Tbl_product::where('user_id',(base64_decode($id)))->get(['p_name']);
        return view('pages.contactus_mail_view', ['user' => $data]);
    }

  
}
