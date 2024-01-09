<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeviceInfo extends Model
{
    use HasFactory;
    protected $table = 'tbl_user_deviceinfo';
    public $timestamps = false;
}
