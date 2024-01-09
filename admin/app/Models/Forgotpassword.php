<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forgotpassword extends Model
{
    use HasFactory;
    protected $table = 'admin_forgot_pass_resets';
    public $timestamps = false;
}
