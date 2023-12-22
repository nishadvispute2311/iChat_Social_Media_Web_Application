<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmUserModel extends Model
{
    use HasFactory;
    protected $table = "smuser";
    public $timestamps = false;
    
}
