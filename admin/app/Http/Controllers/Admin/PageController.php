<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use DB;

class PageController extends Controller
{

    public function update_page(Request $request)
    {
    
        $pages = Page::where('keyword',$request->page_keyword)->first();

        $pages->keyword = $request->page_keyword;
        // dd($request->page_keyword);

        $pages->content = $request->contents;
        // $pages->insertdate = strtotime("now");
        // $pages->updatedate = date('Y-m-d h:i:s');
        // echo"<pre>";print_r($pages);exit;
        if($request->page_keyword == 'about_us'){
            
            // dd("hello");
            $pages->Update();
            return redirect()->route('aboutus')->with('success', 'About Us Updated Successfully');
        } 
        else if($request->page_keyword == 'terms_condition'){
            $pages->Update();
            return redirect()->route('terms_and_condition')->with('success', 'Terms & Conditions Updated Successfully');
        }
         else if($request->page_keyword == 'privacy_policy'){
            $pages->Update();
            return redirect()->route('privacy_policy')->with('success', 'Privacy Policy Updated Successfully');
        }

    }

    public function aboutus(Request $request){
        
        $about_us = Page::where('keyword','about_us')->first();
        // dd($about_us);
        return view('pages.aboutus', compact('about_us'));
    }
    public function privacy_policy(Request $request){
        $privacy_pages = Page::where('keyword','privacy_policy')->first();
        // echo"<pre>";print_r($privacy_pages);exit;
        
        return view('pages.privacy_policy', compact('privacy_pages'));
    }

    public function terms_and_condition(Request $request){
        $term = Page::where('keyword','terms_condition')->first();
        return view('pages.terms_and_conditions', compact('term'));
    }

   
}
