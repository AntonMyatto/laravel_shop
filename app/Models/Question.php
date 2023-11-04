<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'question','img','answers','number_correct_answer'];

    protected $casts = [
        'answers' => 'array'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class,'test_id');
    }

    public function setPropertiesAttribute($value)
    {
        $properties = [];
        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $properties[] = $array_item;
            }
        }
        $this->attributes['properties'] = json_encode($properties);
    }
}
