<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'synopsis',
        'category_id',
        'year',
        'actors',
        'cover_image',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

}
