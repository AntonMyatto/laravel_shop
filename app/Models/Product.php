<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'img', 'description', 'category_id', 'sort', 'published', 'content', 'price', 'slug'];

    protected $casts = [
        'content' => 'array'
    ];

    /** * Return the sluggable configuration array for this model. * * @return array */
    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
