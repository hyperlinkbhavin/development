<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serprodetail extends Model
{
    use HasFactory;
    protected $table = 'tbl_provider_service';
    public $timestamps = false;
}
