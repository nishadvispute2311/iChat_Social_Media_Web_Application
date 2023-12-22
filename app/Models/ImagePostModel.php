<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePostModel extends Model
{
    use HasFactory;
    protected $table="post_image";
    public $timestamps=false;

}
