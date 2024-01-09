<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryReel extends Model
{
    use HasFactory;
    protected $table = 'tbl_provider_story';
    public $timestamps = false;
}
