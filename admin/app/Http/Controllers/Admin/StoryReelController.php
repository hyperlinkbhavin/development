<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoryReel;
use App\Models\Tbl_user;
use App\Helpers\common;

use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Error;
use DB;

class StoryReelController extends Controller
{
    public function reel_list(Request $request)
    {

        $data = StoryReel::where('insert_date', '<', Carbon::now()->subDays(7))->get();
        // dd($data);

        foreach ($data as $story) {
            $story->delete();
        }
        // $db = subcategory::select('id','category_id','subcat_name','is_active')
        //                     ->where('is_delete','0'); 
        // dd($db);tbl_user tbl_provider_story
        // $db = subcategory::with('category')
        if (!common::has_permissions('admin.reel_list')) {
            return view('access_denied');
        } else {

            $story = StoryReel::where('is_delete', '0')->get();
            $db = StoryReel::select(DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_provider_story.id', 'tbl_provider_story.provider_id', 'tbl_provider_story.media_type', 'tbl_provider_story.media_name', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_provider_story.is_active', 'tbl_provider_story.insert_date', 'tbl_provider_story.caption', 'tbl_provider_story.is_delete')
                ->join('tbl_user', 'tbl_provider_story.provider_id', 'tbl_user.id')
                ->where('tbl_provider_story.is_delete', '0')
                // ->where('tbl_provider_story.is_active','1')
                ->where('tbl_user.role', 'provider')
                ->get();
            //    dd($db);

            if ($request->ajax()) {
                $datatable = DataTables::of($db)
                    ->addIndexColumn()

                    ->addColumn('action', function ($row) {
                        $btn = '';

                        if (common::has_permissions('admin.view_reel')) {
                            $btn .= '<a href="' . route('view_reel', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                        }
                        if (common::has_permissions('admin.reel_Status')) {
                            if ($row->is_active == 1) {
                                $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onClick="statusChanged(' . $row->id . ', 0)"> <i class="zmdi zmdi-lock-open"></i> </button>&nbsp;';
                            } else {
                                $btn .= '<button data-rowid="' .  $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onClick="statusChanged(' . $row->id . ', 1)"> <i class="zmdi zmdi-lock"></i> </button>&nbsp;';
                            }
                            // dd($btn1);
                        }
                        if (common::has_permissions('admin.reel_delete')) {
                            $btn .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost(' . $row->id . ')"><i class="zmdi zmdi-delete "></button>';
                        }

                        return $btn;
                    })->addColumn('media_name', function ($row) {
                        $video = '';

                        // $video .= '<img width="470" height="255" src="https://hlink-bhavinp-s3.s3.amazonaws.com/capture/post/video_thumbnail/'.$row->video_thumbnail_file.'" >
                        //      </img>';
                        $video .= "https://bawabat-dev-2.s3.me-central-1.amazonaws.com/bawabat/provider_story/" . $row->media_name . "";


                        // $btn.= '<a data-rowid="' . $row->id . '" href="javascript:void(0)" onClick="deleteFaq('.$row->id.')" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>';

                        return $video;
                    })->addColumn('like', function (StoryReel $row) {

                        $likes = DB::table('tbl_story_like')
                            ->where('story_id', $row['id'])
                            ->count();
                        // dd($row);
                        // $btn1 = '';
                        // if (common::has_permissions('admin.reel_Status')) {
                        //     if ($row->is_active == 1) {
                        //         $btn1 .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onClick="statusChanged(' . $row->id . ', 0)"> <i class="zmdi zmdi-lock-open"></i> </button>';
                        //     } else {
                        //         $btn1 .= '<button data-rowid="' .  $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onClick="statusChanged(' . $row->id . ', 1)"> <i class="zmdi zmdi-lock"></i> </button>';
                        //     }
                        //     // dd($btn1);
                        // }
                        return $likes;
                    })->addColumn('view', function (StoryReel $row) {

                        $views = DB::table('tbl_story_view')
                            ->where('story_id', $row['id'])
                            ->count();
                        // dd($row);
                        // $btn1 = '';
                        // if (common::has_permissions('admin.reel_Status')) {
                        //     if ($row->is_active == 1) {
                        //         $btn1 .= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onClick="statusChanged(' . $row->id . ', 0)"> <i class="zmdi zmdi-lock-open"></i> </button>';
                        //     } else {
                        //         $btn1 .= '<button data-rowid="' .  $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onClick="statusChanged(' . $row->id . ', 1)"> <i class="zmdi zmdi-lock"></i> </button>';
                        //     }
                        //     // dd($btn1);
                        // }
                        return $views;
                    })
                    ->addColumn('is_delete', function (StoryReel $row) {
                        $date = 0;
                        // $currDate = strtotime(date('Y-m-d H:i:s'));
                        // $insertdate = strtotime($row['insertdate']);
                        // echo ($currDate - $insertdate) / 60;
                        // // die;
                        // dd($row['id']);
                        $results = DB::table('tbl_provider_story')
                            ->select(DB::raw('TIMESTAMPDIFF(HOUR, tbl_provider_story.insert_date, CURRENT_TIMESTAMP) as hours'))
                            ->where('id', $row['id'])
                            ->get();
                        if ($results[0]->hours >= 24) {
                            return 1;
                        } else {
                            return 0;
                        }
                    })
                    ->addColumn('provider_names', function ($row) {
                        // dd($row);
                        $btn3 = '';
                        $provider_name = Tbl_user::select(DB::raw('CONCAT(first_name," ",last_name) AS full_name'))
                            ->where('id', $row['provider_id'])
                            ->get();
                        // dd($customer_name[0]['full_name']);

                        $btn3 .= '<a style="color:#444444" href="' . route('view_provider_data', base64_encode($row->provider_id)) . '" data-toggle="tooltip" data-id="' . $row->provider_id . '" data-original-title="Show">' . $provider_name[0]['full_name'] . '</a>';
                        // $btn.= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost('.$row->id.')"><i class="zmdi zmdi-delete "></button>';

                        return $btn3;
                    })
                    ->rawColumns(['is_delete', 'action', 'status', 'provider_names'])->make(true);
                // dd($datatable);
                return $datatable;
            } else {

                $data = StoryReel::select(DB::raw('CONCAT(tbl_user.first_name," ",tbl_user.last_name) AS full_name'), 'tbl_provider_story.id', 'tbl_provider_story.media_type', 'tbl_provider_story.media_name', 'tbl_user.first_name', 'tbl_user.last_name', 'tbl_provider_story.is_active', DB::raw("count(tbl_story_like.id) as likes"), DB::raw("count(tbl_story_view.id) as view"))
                    ->join('tbl_user', 'tbl_provider_story.provider_id', 'tbl_user.id')
                    ->leftjoin('tbl_story_view', 'tbl_provider_story.id', 'tbl_story_view.story_id')
                    ->leftjoin('tbl_story_like', 'tbl_provider_story.id', 'tbl_story_like.story_id')

                    ->where('tbl_provider_story.is_delete', '0')
                    ->where('tbl_user.role', 'provider')
                    ->groupBy('tbl_provider_story.id')

                    ->get();

                // DB::table('website_tags')
                //     ->join('assigned_tags', 'website_tags.id', '=', 'assigned_tags.tag_id')
                //     ->select('website_tags.id as id', 'website_tags.title as title', DB::raw("count(assigned_tags.tag_id) as count"))
                //     ->groupBy('website_tags.id')
                //     ->get();

                return view('StoryReel.storyreelist', compact('db', 'data', 'story'));
            }
        }
    }

    public function reel_Status(Request $request)
    {
        $status = StoryReel::find($request->id);
        //  dd($status);
        $status->is_active = $request->action;
        // dd($status->is_active);
        $status->update();

        return response()->json(['code' => 1, 'message' => 'User Status Changed Successfully.']);
    }

    public function view_reel(Request $request, $id)
    {
        $data = StoryReel::find(base64_decode($id));

        $views = DB::table('tbl_story_view')
            ->where('story_id', $data['id'])
            ->get();

        $likes = DB::table('tbl_story_like')
            ->where('story_id', $data['id'])
            ->get();
        // $product = Tbl_user::where('id',(base64_decode($id)))->get(['first_name']);
        // dd($product);
        return view('StoryReel.storyreelview', ['user' => $data, 'views' => $views, 'likes' => $likes]);
    }

    public function reel_delete(Request $request)
    {
        // echo"<pre>";print_r($id);die;

        StoryReel::where('id', $request->id)
            ->update([
                // 'password' => $new_password,
                'is_delete' => '1'
            ]);
    }
}
