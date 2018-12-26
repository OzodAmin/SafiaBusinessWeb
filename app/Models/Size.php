<?php

namespace App\Models;

use Eloquent as Model;

class Size extends Model {
  
    public $table = 'size';
    public $timestamps = false;
    protected $fillable = ['title'];

    public static $rules = [
        'title' => 'required|string|min:1|max:255',
    ];
}
