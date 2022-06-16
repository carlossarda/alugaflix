<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string name
 * @property int size
 * @property false|string file
 * @property mixed id
 */
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
        return $this->belongsToMany(Tag::class, 'movie_tags', 'movie_id', 'tag_id')
            ->wherePivotNull('deleted_at');
    }
}
