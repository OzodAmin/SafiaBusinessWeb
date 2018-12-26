<?php

namespace App\Models;

use Eloquent as Model;

class CityTranslation extends Model
{
    public $timestamps = false;

    public $fillable = [
        'title',
    ];

    public static $rules = [
        'title' => 'required|string|min:3'
    ];
}