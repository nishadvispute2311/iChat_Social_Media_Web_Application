<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BdayModel extends Model
{
    use HasFactory;
    protected $table = "bdstatus";
    public $timestamps = false;
}
