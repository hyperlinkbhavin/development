<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    // public $table = 'tbl_admin';
    protected $fillable = ['title'];


    public function getPermissions($id)
    {
        // return !empty($this->permissions) ? json_decode($this->permissions, true) : [];
        // print_r($this['permissions']); die;

        $result = Admin::select('permissions')->where('id',$id)->first();
        // print_r($result->permissions); die;
        return !empty($result->permissions) ? json_decode($result->permissions, true) : [];
        // return $this->permissions;
    }

}
