<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string name
 */
class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name"
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_tags', 'tag_id', 'movie_id');
    }
}
