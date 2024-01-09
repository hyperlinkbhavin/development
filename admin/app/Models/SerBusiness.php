<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerBusiness extends Model
{
    use HasFactory;
    protected $table = 'tbl_provider_business';
    public $timestamps = false;
}
