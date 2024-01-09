<?php

namespace App\Helpers;

use DB;
use Auth;

class common
{
    public static function has_permissions($route)
    {

        $result = DB::table('admins')->select('id', 'role', 'permissions')->where('is_active', 1)->where('is_delete',0)
            ->where('id', Auth::guard('admin')->id())
            ->first();
        // dd($result);

        // print_r($result);
        if ($result != null) {

            if ($result->role != 'S') {
                $array = json_decode($result->permissions);
                // print_r($array);

                if ($array != null) {

                    foreach ($array as $value) {
                        if (strcmp($route, $value) == 0) {
                            //   print_r($value);

                            return true;
                        }
                    }
                    return false;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            // dd('hello');
            return false;
            // return redirect()->route('admin_contact');
        }
    }
}
