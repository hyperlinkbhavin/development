<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    use HasFactory;
    protected $table = 'tbl_admin_menu';
    public $timestamps = false;

    public function getChildMenus($id)
    {
        return AdminMenu::where('parent_id',$id)->where('status',1)->get();
    }
}
