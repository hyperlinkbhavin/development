<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\common;
use App\Models\subcategory;
use App\Models\serviceCategory;

use Yajra\DataTables\DataTables;
use Error;
// use DB;

class SubCatController extends Controller
{
    public function service_subcategories(Request $request)
    {
        // $db = subcategory::select('id','category_id','subcat_name','is_active')
        //                     ->where('is_delete','0'); 
        // dd($db);
        // $db = subcategory::with('category')

        if (!common::has_permissions('admin.service_subcategories')) {
            return view('access_denied');
        } else {

            $db = subcategory::select('tbl_service_subcategory.id', 'tbl_service_subcategory.name as subcat_name', 'tbl_service_category.id AS cat_id', 'tbl_service_category.name', 'tbl_service_subcategory.is_active', 'tbl_service_subcategory.is_delete')
                ->join('tbl_service_category', 'tbl_service_subcategory.category_id', 'tbl_service_category.id')
                ->where('tbl_service_subcategory.is_delete', '0')
                ->get();
            //    dd($db);

            if ($request->ajax()) {
                $datatable = DataTables::of($db)
                    ->addIndexColumn()
                    // ->addColumn('name',function($row){
                    //     $btn = '';
                    //     $btn = $row->name;
                    //     return $btn;

                    // })
                    ->addColumn('action', function ($row) {
                        $btn = '';

                        if (common::has_permissions('admin.subcategories_edit')) {
                            $btn .= '<a href="' . route('subcategories_edit', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>&nbsp;';
                        }

                        if (common::has_permissions('admin.view_subcategories_data')) {
                            $btn .= '<a href="' . route('view_subcategories_data', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                        }

                        if (common::has_permissions('admin.subcategories_delete')) {
                            $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost(' . $row->id . ')"><i class="zmdi zmdi-delete "></button>';
                        }

                        return $btn;
                    })->addColumn('status', function (subcategory $row) {
                        // dd($row);
                        $btn1 = '';
                        if (common::has_permissions('admin.subcategories_Status')) {
                            if ($row->is_active == 1) {
                                $btn1 .= '<button data-rowid="' . $row->id . '" style="width:59px" class="btn btn-raised bg-green waves-effect" onClick="statusChanged(' . $row->id . ', 0)"> Active </button>';
                            } else {
                                $btn1 .= '<button data-rowid="' .  $row->id . '" class="btn  btn-raised btn-danger waves-effect" onClick="statusChanged(' . $row->id . ', 1)"> Inactive </button>';
                            }
                            // dd($btn1);
                        }
                        return $btn1;
                    })->rawColumns(['action', 'status'])->make(true);
                // dd($datatable);
                return $datatable;
            } else {
                $data = subcategory::select('tbl_service_subcategory.id', 'tbl_service_subcategory.name as subcat_name', 'tbl_service_category.id AS cat_id', 'tbl_service_category.name', 'tbl_service_subcategory.is_active', 'tbl_service_subcategory.is_delete')
                    ->join('tbl_service_category', 'tbl_service_subcategory.category_id', 'tbl_service_category.id')
                    ->where('tbl_service_subcategory.is_delete', '0')->where('tbl_service_subcategory.is_active', '1')->get();

                return view('ServiceSubCategory.subcategorylist', compact('db', 'data'));
            }
        }
    }
    public function subcategories_Status(Request $request)
    {

        $status = subcategory::find($request->id);
        //  dd($status);
        $status->is_active = $request->action;
        // dd($status->is_active);
        $status->update();

        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }

    public function view_subcategories_data(Request $request, $id)
    {
        $data = subcategory::find(base64_decode($id));
        // dd($data['category_id']);
        $cat_id = $data['category_id'];
        // $cat = serviceCategory::where('id',(base64_decode($id)))->get(['name']);
        // dd(base64_decode($request->id));
        // dd($cat);
        $user = serviceCategory::where('id', $cat_id)->get();
        // dd($user[0]['name']);
        // DB::enableQueryLog();
        // $provider = subcategory::select('tbl_service_subcategory.*', 'tbl_provider_service.provider_id')
        //     ->join('tbl_provider_service', 'tbl_service_subcategory.id', '=', 'tbl_provider_service.sub_category_id')
        //     ->where('tbl_service_subcategory.id', $data['id'])
        //     ->groupBy('tbl_provider_service.provider_id')
        //     ->get();
        // // DB::enableQueryLog();
        // dd($provider);

        $provider = DB::table('tbl_provider_service')
            ->where('sub_category_id', '=', $data['id'])
            ->groupBy('provider_id')
            ->get();

            $service = DB::table('bawabat.tbl_provider_service')
            ->where('sub_category_id', '=', $data['id'])
            ->get();

        return view('ServiceSubCategory.subcatview', ['user' => $data, 'cat' => $user, 'provider' => $provider, 'service'=>$service]);
    }

    public function subcategories_delete(Request $request)
    {

        subcategory::where('id', $request->id)
            ->update([
                // 'password' => $new_password,
                'is_delete' => '1'
            ]);
    }

    public function subcategories_edit(Request $request, $id)
    {
        $data = subcategory::find(base64_decode($id));
        // $users = serviceCategory::select('name')->get();
        $users = serviceCategory::get();
        // dd($data);
        return view('ServiceSubCategory.editsubcat', ['user' => $data, 'cat' => $users]);
    }

    public function update_subcategories(Request $request)
    {
        // dd($request->id);
        $addUser = subcategory::find($request->id);
        // dd($addUser);
        $addUser->name = $request->name;
        $addUser->category_id = $request->category_id;

        // $addUser->updatedate = date('Y-m-d h:i:s');
        $addUser->update();
        // $about_us = Pages::where('type','about_us')->first();
        return redirect()->route('service_subcategories')->with('success', 'SubCategory Updated Successfully');
    }


    public function add_subcat(Request $request)
    {
        if (!common::has_permissions('admin.add_subcat')) {
            return view('access_denied');
        }
        $users = serviceCategory::get();
        return view('ServiceSubCategory.addsubcat', compact('users'));
    }

    public function add_subcategories(Request $request)
    {
        // dd($request->input());
        $addUser = new subcategory();
        $addUser->category_id = $request->category_id;
        $addUser->name = $request->name ?? '';
        $addUser->is_active = '1';
        // $addUser->insertdate = strtotime("now");
        // $addUser->updatedate = date('Y-m-d h:i:s');
        // echo"<pre>";print_r(strtotime("now"));exit;
        $addUser->save();
        return redirect()->route('service_subcategories')->with('success', 'SubCategory Added Successfully');
    }
}
