<?php

namespace App\Models\Interaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'status',
        'total',
    ];
}
