<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'file',
        'size',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'movie_tags', 'movie_id', 'tag_id');
    }
}
