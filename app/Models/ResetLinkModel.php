<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetLinkModel extends Model
{
    use HasFactory;
    protected $table = "reset_link";
    public $timestamps = false;
}
