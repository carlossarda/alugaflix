<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovieTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "movie_id",
        "tag_id"
    ];
}
