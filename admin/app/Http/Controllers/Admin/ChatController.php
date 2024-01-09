<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tbl_user;
use App\Models\ChatReply;
use App\Models\ChatRoom;
use App\Helpers\common;

use Yajra\DataTables\DataTables;
use Error;
use DB;

class ChatController extends Controller
{
    public function manage_chat(Request $request)
    {

        if (!common::has_permissions('admin.manage_chat')) {
            return view('access_denied');
        } else {

            $db = ChatRoom::select(DB::raw('DATE_FORMAT(FROM_UNIXTIME(tbl_chat_room.insert_datetime), "%e %b %Y, %H:%i:%S") AS date_formatted '), DB::raw('DATE_FORMAT(FROM_UNIXTIME(tbl_chat_room.update_datetime), "%e %b %Y, %H:%i:%S") AS modify_date '), DB::raw('CONCAT(u1.first_name," ",u1.last_name) AS full_name'), DB::raw('CONCAT(u2.first_name," ",u2.last_name) AS receiver_name'), 'tbl_chat_room.user_id1','tbl_chat_room.user_id2', 'u1.id', 'tbl_chat_room.id', 'u1.first_name', 'u2.first_name', 'tbl_chat_room.insert_datetime', 'tbl_chat_room.update_datetime')
                ->join('tbl_user as u1', 'tbl_chat_room.user_id1', 'u1.id')
                ->join('tbl_user as u2', 'tbl_chat_room.user_id2', 'u2.id')
                ->where('tbl_chat_room.is_active', '1')
                ->get();
            //    dd($db);        

            if ($request->ajax()) {
                $datatable = DataTables::of($db)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '';

                        if (common::has_permissions('admin.chat_view')) {

                            $btn .= '<a href="' . route('chat_view', base64_encode($row->id)) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-eye"></i></a>&nbsp;';
                        }
                        // $btn.= '<a href="' . route('video_delete', base64_encode($row->id)) .'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Show" class="btn btn-raised waves-effect waves-float waves-green"><i class="zmdi zmdi-delete "></i></a>&nbsp;';
                        // $btn.= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost('.$row->id.')"><i class="zmdi zmdi-delete "></button>';

                        return $btn;
                    })->addColumn('customer_names', function ($row) {
                        $btn = '';
                        $customer_name = Tbl_user::select(DB::raw('CONCAT(first_name," ",last_name) AS full_name'))
                            ->where('id', $row['user_id1'])
                            ->get();
                        // dd($customer_name[0]['full_name']);

                        $btn .= '<a style="color:#444444" href="' . route('view_user_data', base64_encode($row->user_id1)) . '" data-toggle="tooltip" data-id="' . $row->user_id1 . '" data-original-title="Show">' . $customer_name[0]['full_name'] . '</a>';
                        // $btn.= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost('.$row->id.')"><i class="zmdi zmdi-delete "></button>';

                        return $btn;
                    })
                    ->addColumn('provider_names', function ($row) {
                        // dd($row);
                        $btn = '';
                        $provider_name = Tbl_user::select(DB::raw('CONCAT(first_name," ",last_name) AS full_name'))
                            ->where('id', $row['user_id2'])
                            ->get();
                        // dd($customer_name[0]['full_name']);

                        $btn .= '<a style="color:#444444" href="' . route('view_provider_data', base64_encode($row->user_id2)) . '" data-toggle="tooltip" data-id="' . $row->user_id2 . '" data-original-title="Show">' . $provider_name[0]['full_name'] . '</a>';
                        // $btn.= '<button data-rowid="' . $row->id . '" class="btn btn-raised waves-effect waves-float waves-green" onclick="deletePost('.$row->id.')"><i class="zmdi zmdi-delete "></button>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'customer_names','provider_names'])->make(true);
                return $datatable;
            } else {
                return view('Chat.chatlist', compact('db'));
            }
        }
    }
    // ->where('user_id','8')
    public function chat_view(Request $request, $id)
    {
        $data = ChatRoom::find(base64_decode($id));
        // dd($data);

        $messages = ChatReply::select(DB::raw('DATE_FORMAT(FROM_UNIXTIME(tbl_chat_reply.insert_datetime), "%e %b %Y %I:%i %p") AS date_formatted'), 'tbl_chat_reply.message', 'tbl_chat_reply.type', 'tbl_chat_reply.user_id', 'tbl_user.first_name', 'tbl_user.last_name')
            ->join('tbl_user', 'tbl_chat_reply.user_id', 'tbl_user.id')
            ->where('tbl_chat_reply.chat_id', (base64_decode($id)))
            ->get();

        // $messages = ChatReply::select(DB::raw('DATE_FORMAT(FROM_UNIXTIME(insert_datetime), "%e %b %Y %I:%i:%S %p") AS date_formatted '),'message','user_id','type')

        // ->where('chat_id',(base64_decode($id)))
        // ->get(); 

        return view('Chat.chatview', ['user_id' => $data['user_id1'], 'message' => $messages]);
    }
}
