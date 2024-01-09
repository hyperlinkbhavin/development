<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;
    protected $table = 'tbl_service_subcategory';
    public $timestamps = false;

    public function category(){
        return $this->hasMany('App\Models\serviceCategory','id','category_id');
    }

}
