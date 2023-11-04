<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'img','content','published','type'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->as('tags');
    }
}
