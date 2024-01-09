<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\serviceCategory;
use App\Models\subcategory;
use Yajra\DataTables\DataTables;
use App\Helpers\s3upload;
use App\Helpers\common;

use Illuminate\Support\Facades\Validator;

use Storage;
use Error;
use DB;

class ServiceCatController extends Controller
{
    public function service_categories(Request $request)
    {
        // print_r(common::has_permissions('admin.service_categories')); die;
        if (!common::has_permissions('admin.service_categories')) {
            return view('access_denied');
        } else {
            $db = serviceCategory::select('id', 'name', 'image', 'is_active', 'insert_date')
                ->where('is_delete', '0')
                ->get();
            // dd($db);


            if ($request->ajax()) {
                $datatable = DataTables::of($db)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '';

                        if (common::has_permissions('admin.categories_edit')) {
                            $btn .= '<a href="' . route('categories_edit', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-edit"></i></a>&nbsp;';
                        }

                        if (common::has_permissions('admin.view_categories_data')) {

                            $btn .= '<a href="' . route('view_categories_data', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                        }

                        if (common::has_permissions('admin.categories_delete')) {

                            $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost(' . $row->id . ')"><i class="zmdi zmdi-delete "></button>';
                        }

                        return $btn;
                    })->addColumn('image', function ($row) {

                        $video = '';
                        // $video .= '<img width="470" height="255" src="https://hlink-bhavinp-s3.s3.amazonaws.com/capture/post/video_thumbnail/'.$row->video_thumbnail_file.'" >
                        //      </img>';
                        $video .=  "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/category/" . $row->image . "";

                        // $video ='<a href="https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/category/' . $row->image . '" class="image-popup" >
                        // <img style="height:60px;width:60px" src="https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/category/' . $row->image . '" class="img-fluid d-block rounded"   width="400" alt="creator-image">
                        // </a>';
                        // $btn.= '<a data-rowid="' . $row->id . '" href="javascript:void(0)" onClick="deleteFaq('.$row->id.')" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>';
                        // dd($video);

                        return $video;
                    })->addColumn('status', function (serviceCategory $row) {
                        // dd($row);
                        $btn1 = '';

                        if (common::has_permissions('admin.categories_Status')) {

                            if ($row->is_active == 1) {
                                $btn1 .= '<button data-rowid="' . $row->id . '" style="width:59px" class="btn btn-raised bg-green waves-effect" onClick="statusChanged(' . $row->id . ', 0)"> Active </button>';
                            } else {
                                $btn1 .= '<button data-rowid="' .  $row->id . '" class="btn  btn-raised btn-danger waves-effect" onClick="statusChanged(' . $row->id . ', 1)"> Inactive </button>';
                            }
                        }
                        // dd($btn1);

                        return $btn1;
                    })->rawColumns(['action', 'status'])->make(true);
                return $datatable;
            } else {
                $data = serviceCategory::where('is_delete', '0')->get();

                return view('ServiceCategory.servicecategory', compact('db', 'data'));
            }
        }
    }

    public function view_image($img)
    {

        // dd(base64_decode($img));
        print_r('<img src=' . base64_decode($img) . ' >');
    }

    public function categories_Status(Request $request)
    {

        $status = serviceCategory::find($request->id);
        //  dd($status);
        $status->is_active = $request->action;
        // dd($status->is_active);
        $status->update();

        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }

    public function categories_delete(Request $request){
        // echo"<pre>";print_r($id);die;
       
        // dd($record);
        serviceCategory::where('id', $request->id)
        ->update([
            // 'password' => $new_password,
            'is_delete' => '1'
        ]);
    }

    public function view_categories_data(Request $request, $id)
    {

        $data = serviceCategory::find(base64_decode($id));
        // dd($data['id']);

        // number of subcategory 
        $num_sub_cat = serviceCategory::select('tbl_service_category.*', 'tbl_service_subcategory.*')
            ->join('tbl_service_subcategory', 'tbl_service_category.id', 'tbl_service_subcategory.category_id')
            ->where('tbl_service_category.id', $data['id'])
            ->get();
        //   dd($num_sub_cat);
        // $provider = serviceCategory::select('tbl_service_category.*', 'tbl_provider_service.*')
        //     ->join('tbl_provider_service', 'tbl_service_category.id', 'tbl_provider_service.category_id')
        //     ->where('tbl_service_category.id', $data['id'])
        //     ->groupBy('tbl_provider_service.provider_id')
        //     ->get();

            $provider = ServiceCategory::select('tbl_service_category.*', 'tbl_provider_service.provider_id')
            ->join('tbl_provider_service', 'tbl_service_category.id', '=', 'tbl_provider_service.category_id')
            ->where('tbl_service_category.id', $data['id'])
            ->groupBy('tbl_provider_service.provider_id')
            ->get();
            // dd($provider);

        $service =  serviceCategory::select('tbl_service_category.*', 'tbl_provider_service.*')
            ->join('tbl_provider_service', 'tbl_service_category.id', 'tbl_provider_service.category_id')
            ->where('tbl_service_category.id', $data['id'])
            ->get();

        return view('ServiceCategory.servicecatogoryview', ['user' => $data, 'num_sub_cat' => $num_sub_cat, 'service' => $service, 'provider' => $provider]);
    }



    public function add_cat(Request $request)
    {
        if (!common::has_permissions('admin.add_cat')) {
            return view('access_denied');
        }
        return view('ServiceCategory.addcategory');
    }


    public function add_categories(Request $request)
    {
// dd($request->input());

        // $image = $request->file('image');
        // $name = uniqid().'.'.$image->getClientOriginalExtension();
        // $filePath = public_path('/resources/images');
        // $image->move($destinationPath, $name);
        $rules = array(

            'image' => 'required|mimes:jpeg,png,jpg'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        } else {

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = time() . str_replace(' ', '_', $imageName);
            $file = $_FILES['image']['tmp_name'];
            // dd($file);
            $path = env('AWS_BUCKET_FOLDER') . env('CATEGORY_IMAGE');  
            $contents = s3upload::uploadImage($imageName, $file, $path);
            // dd($contents);

            $images = $contents;

            // $image = $request->file('image');
            // $image_name = uniqid() .'.'. $image->getClientOriginalExtension();
            // $filePath = env('AWS_BUCKET_FOLDER') . env('CATEGORY_IMAGE');
            // Storage::disk('s3')->put($filePath, file_get_contents($image->getRealPath()), 'public');

            // dd($request);
            $addUser = new serviceCategory();
            $addUser->name = $request->name ?? '';
            $addUser->image = $images ?? '';
            $addUser->is_active = '0';
            // dd($addUser->id );
            // $addUser->insertdate = strtotime("now");
            // $addUser->updatedate = date('Y-m-d h:i:s');
            // echo"<pre>";print_r(strtotime("now"));exit; 
            $addUser->save();
            $addUser->id;
// dd($addUser->id);
            $subcat = new subcategory();
            $subcat->category_id = $addUser->id;
            $subcat->name = 'others';
            $subcat->is_active = '1';
            $subcat->is_delete = '0';
            $subcat->save();

            return redirect()->route('service_categories')->with('success', 'Category Added Successfully');
        }
    }


    public function categories_edit(Request $request, $id)
    {
        $faq = serviceCategory::find(base64_decode($id));
        // dd($faq['image']);
        return view('ServiceCategory.editervicecategory', ['user' => $faq]);
    }

    public function update_categories(Request $request)
    {
        // dd($request->id);
        $rules = array(
            'image' => 'mimes:jpeg,png,jpg'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        } else {

            $addUser = serviceCategory::find($request->id);
            // dd($addUser);
            if ($file1 = $request->file('image')) {

                $imageName = $file1->getClientOriginalName();
                $imageName = time() . str_replace(' ', '_', $imageName);
                $file = $_FILES['image']['tmp_name'];
                $path = env('AWS_BUCKET_FOLDER') . env('CATEGORY_IMAGE');
                $contents = s3upload::uploadImage($imageName, $file, $path);
                $image = $contents;
                // dd($path);
                $addUser->image = $image;
            }

            $addUser->name = $request->name;

            // $addUser->updatedate = date('Y-m-d h:i:s');
            $addUser->update();
            
          

            // $about_us = Pages::where('type','about_us')->first();
            return redirect()->route('service_categories')->with('success', 'Category Updated Successfully');
        }
    }
}
