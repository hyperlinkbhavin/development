<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fevourite extends Model
{
    use HasFactory;
    protected $table = 'tbl_fevourite';
    public $timestamps = false;
}
