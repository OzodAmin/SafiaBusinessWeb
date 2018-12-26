<?php

namespace App\Models;

use Eloquent as Model;

class DistrictTranslation extends Model {

    public $timestamps = false;

    public $fillable = [
        'title',
    ];

    public static $rules = [
        'title' => 'required|string|min:3'
    ];
}
