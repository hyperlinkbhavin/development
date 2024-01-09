<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Tbl_user;
use App\Models\TblDeviceInfo;
use App\Models\serprodetail;
use App\Models\SerBusiness;
use App\Models\ServiceTime;
use App\Models\ServiceImage;
use App\Models\Country;
use Yajra\DataTables\DataTables;
use App\Helpers\common;

use Error;
use DB;

class Servicecontroller extends Controller
{
    public function service_list(Request $request)
    {

        if (!common::has_permissions('admin.service_provider')) {
            return view('access_denied');
        } else {
            // DB::enableQueryLog(); 
            $data = serprodetail::select('tbl_provider_service.id',  'tbl_provider_service.provider_id', 'tbl_provider_service.service_name', 'tbl_provider_service.description', 'tbl_provider_service.minimum_rate', 'tbl_provider_service.maximum_rate', 'tbl_service_category.name', 'tbl_service_subcategory.name as subcat_name', 'tbl_provider_service.insert_date', 'tbl_provider_service.total_avg_rating')
                
                ->join('tbl_service_category', 'tbl_provider_service.category_id', 'tbl_service_category.id')
                ->join('tbl_service_subcategory', 'tbl_provider_service.sub_category_id', 'tbl_service_subcategory.id')
                // ->where('tbl_provider_service.provider_id', $request->id)
                // ->whereBetween('tbl_provider_service.insert_date', [$request->start_date, $request->end_date])
                ->where('tbl_provider_service.is_delete', '0')
                ->get();

           // Enable query log

                // Your Eloquent query executed by using get()
                
                // dd(DB::getQueryLog()); 

// dd($data);
                
            return view('Services.servicelist', compact('data'));
        }
    }

    public function date_filter(Request $request)
    {


        if ($request->start_date != null && $request->end_date != null) {
            // $product = serprodetail::select('tbl_provider_service.id', 'tbl_provider_service.provider_id', 'tbl_provider_service.service_name', 'tbl_provider_service.description', 'tbl_provider_service.minimum_rate', 'tbl_provider_service.maximum_rate', 'tbl_service_category.name', 'tbl_service_subcategory.name as subcat_name', 'tbl_provider_service.insert_date','tbl_provider_service.total_avg_rating')
            //     ->join('tbl_service_category', 'tbl_provider_service.category_id', 'tbl_service_category.id')
            //     ->join('tbl_service_subcategory', 'tbl_provider_service.sub_category_id', 'tbl_service_subcategory.id')
            //     // ->where('tbl_provider_service.provider_id', $request->id)
            //     ->whereBetween('tbl_provider_service.insert_date', [$request->start_date, $request->end_date])
            //     ->where('tbl_provider_service.is_delete', '0')
            //     ->get();

            $product = serprodetail::select('tbl_provider_service.id',DB::raw('CONCAT(tbl_user.first_name, " ", tbl_user.last_name) AS provider_name'), 'tbl_provider_service.provider_id', 'tbl_provider_service.service_name', 'tbl_provider_service.description', 'tbl_provider_service.minimum_rate', 'tbl_provider_service.maximum_rate', 'tbl_service_category.name', 'tbl_service_subcategory.name as subcat_name', 'tbl_provider_service.insert_date', 'tbl_provider_service.total_avg_rating')
            ->join('tbl_user', 'tbl_provider_service.provider_id', '=', 'tbl_user.id')

                ->join('tbl_service_category', 'tbl_provider_service.category_id', 'tbl_service_category.id')
                ->join('tbl_service_subcategory', 'tbl_provider_service.sub_category_id', 'tbl_service_subcategory.id')
                ->where(function ($query) use ($request) {
                    $query->whereDate('tbl_provider_service.insert_date', '>=', $request->start_date)
                        ->whereDate('tbl_provider_service.insert_date', '<=', $request->end_date);
                })
                ->where('tbl_provider_service.is_delete', '0')
                ->get();
        } else if ($request->start_date != null && $request->end_date == null) {
            $product = serprodetail::select('tbl_provider_service.id',DB::raw('CONCAT(tbl_user.first_name, " ", tbl_user.last_name) AS provider_name'), 'tbl_provider_service.provider_id', 'tbl_provider_service.service_name', 'tbl_provider_service.description', 'tbl_provider_service.minimum_rate', 'tbl_provider_service.maximum_rate', 'tbl_service_category.name', 'tbl_service_subcategory.name as subcat_name', 'tbl_provider_service.insert_date', 'tbl_provider_service.total_avg_rating')
            ->join('tbl_user', 'tbl_provider_service.provider_id', '=', 'tbl_user.id')

                ->join('tbl_service_category', 'tbl_provider_service.category_id', 'tbl_service_category.id')
                ->join('tbl_service_subcategory', 'tbl_provider_service.sub_category_id', 'tbl_service_subcategory.id')
                ->where('tbl_provider_service.insert_date', '>=', $request->start_date)
                ->where('tbl_provider_service.is_delete', '0')
                ->get();
        } else if ($request->start_date == null && $request->end_date != null) {
            $product = serprodetail::select('tbl_provider_service.id',DB::raw('CONCAT(tbl_user.first_name, " ", tbl_user.last_name) AS provider_name'), 'tbl_provider_service.provider_id', 'tbl_provider_service.service_name', 'tbl_provider_service.description', 'tbl_provider_service.minimum_rate', 'tbl_provider_service.maximum_rate', 'tbl_service_category.name', 'tbl_service_subcategory.name as subcat_name', 'tbl_provider_service.insert_date', 'tbl_provider_service.total_avg_rating')
            ->join('tbl_user', 'tbl_provider_service.provider_id', '=', 'tbl_user.id')

                ->join('tbl_service_category', 'tbl_provider_service.category_id', 'tbl_service_category.id')
                ->join('tbl_service_subcategory', 'tbl_provider_service.sub_category_id', 'tbl_service_subcategory.id')
                ->where('tbl_provider_service.insert_date', '<=', $request->end_date)
                ->where('tbl_provider_service.is_delete', '0')
                ->get();
        } else {
            $product = serprodetail::select('tbl_provider_service.id',DB::raw('CONCAT(tbl_user.first_name, " ", tbl_user.last_name) AS provider_name'), 'tbl_provider_service.provider_id', 'tbl_provider_service.service_name', 'tbl_provider_service.description', 'tbl_provider_service.minimum_rate', 'tbl_provider_service.maximum_rate', 'tbl_service_category.name', 'tbl_service_subcategory.name as subcat_name', 'tbl_provider_service.insert_date', 'tbl_provider_service.total_avg_rating')
            ->join('tbl_user', 'tbl_provider_service.provider_id', '=', 'tbl_user.id')

                ->join('tbl_service_category', 'tbl_provider_service.category_id', 'tbl_service_category.id')
                ->join('tbl_service_subcategory', 'tbl_provider_service.sub_category_id', 'tbl_service_subcategory.id')
                // ->where('tbl_provider_service.provider_id', $request->id)
                // ->whereBetween('tbl_provider_service.insert_date', [$request->start_date, $request->end_date])
                ->where('tbl_provider_service.is_delete', '0')
                ->get();
        }

        // dd($product);
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
                })
                ->addColumn('reviews', function (serprodetail $row) {
                    // dd($row);
                    $btn2 = '';
                    //     $btn .= '<a href="' . route('provider_time', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-time"></i>
                    // </a>&nbsp;';

                    $btn2 .= '<a href="' . route('review', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green btn_image"><i class="zmdi zmdi-star"></i></a>&nbsp;';

                    return $btn2;
                })->rawColumns(['time', 'images', 'reviews'])->make(true);
            return $datatable;
        } else {
            $data = serprodetail::select('tbl_provider_service.id', 'tbl_provider_service.provider_id', 'tbl_provider_service.service_name', 'tbl_provider_service.description', 'tbl_provider_service.minimum_rate', 'tbl_provider_service.maximum_rate', 'tbl_service_category.name', 'tbl_service_subcategory.name as subcat_name', 'tbl_provider_service.insert_date')
                ->join('tbl_service_category', 'tbl_provider_service.category_id', 'tbl_service_category.id')
                ->join('tbl_service_subcategory', 'tbl_provider_service.sub_category_id', 'tbl_service_subcategory.id')
                // ->where('tbl_provider_service.provider_id', $request->id)
                // ->whereBetween('tbl_provider_service.insert_date', [$request->start_date, $request->end_date])
                ->where('tbl_provider_service.is_delete', '0')
                ->get();

            return view('Services.servicelist', compact('product', 'data'));
        }
    }

    public function provider_time(Request $request, $id)
    {

        // $data = ServiceTime::find(base64_decode($id));
        // dd(base64_decode($id));
        return view('serviceProvider.servicetime', ['user' => base64_decode($id)]);
    }

    public function provider_images(Request $request, $id)
    {

        $data = ServiceImage::select('image')
            ->where('service_id', base64_decode($id))
            ->get();
        // dd($data);
        return view('serviceProvider.serviceimages', ['user' => $data]);
    }

    public function review(Request $request, $id)
    {
        // dd($id);
        $data = DB::table('tbl_rate_review')
            ->where('for_id', base64_decode($id))
            ->get();
        // dd($data);
        return view('Services.review', ['user' => $data]);
    }
}
