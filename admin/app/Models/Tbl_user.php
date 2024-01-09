<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
;

class Tbl_user extends Model
{
    use HasFactory;

    protected $table = 'tbl_user';
    public $timestamps = false;

}
