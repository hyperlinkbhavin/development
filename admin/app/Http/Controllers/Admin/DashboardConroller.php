<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tbl_user;
use App\Models\serviceCategory;
use App\Models\subcategory;
use App\Models\Reel;
use App\Models\StoryReel;
class DashboardConroller extends Controller
{

      
        function index(){
            
            $customer = Tbl_user::where('role','customer')->get();
            $provider = Tbl_user::where('role','provider')->get();
            // dd($provider);
            $Category = serviceCategory::where('is_delete','0')->get();
            $SubCategory = subcategory::where('is_delete','0')->get(['name']);
            // dd($SubCategory);
            $Advertisement = Reel::where('is_delete','0')->get();
            $reel = StoryReel::where('is_delete','0')->get();
            // dd($users);
            // $video = Post::all();
    
            return view('Dashboard.dashboard', compact(['customer','provider','Category','SubCategory','Advertisement','reel']));
        }
        
    
}
