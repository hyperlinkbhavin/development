<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coins;
use App\Helpers\common;

use Yajra\DataTables\DataTables; 
use Error;
use DB;

class CoinsController extends Controller
{
    public function view_coins(Request $id){
        // dd($id);

        $data = Coins::where('id','1')->get();
        // dd($data[0]['commission']);
        $isDisabled = 'Coin =';
        return view('Coins.coins_view',['data'=>$data,'a'=>$isDisabled]);
    }

    public function update_coins(Request $request){
        if (!common::has_permissions('admin.update_coins')) {
            return view('access_denied');
        }
        // dd($request);
        $data = Coins::find($request->id);
        // dd($data);
        $data->sign_up_coins = $request->sign_up_coins ?? '';
        $data->referral_coins = $request->referral_coins ?? '';

        $data->review_coins = $request->review_coins ?? '';
        $data->doller = $request->doller ?? '';

        $data->update();
        return redirect()->route('view_coins');
    }
}
