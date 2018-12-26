<?php

namespace App\Models;

use Eloquent as Model;

class BaseTranslation extends Model {

    public $table = 'base_translations';

    public static function boot() {

        parent::boot();

        static::creating( function($base_translations) {

            $base_translations->slug = str_slug($base_translations->title);

            $latest_slug =static::whereRaw("slug RLIKE '^{$base_translations->slug}(-[0-9]*)?$'")
                                    ->latest('id')
                                    ->value('slug');

            if( $latest_slug ) {

                $pieces = explode('-', $latest_slug);
                $number = intval(end($pieces));

                $base_translations->slug .= '-' . ($number + 1);
            }

        });
    }

    public $timestamps = false;

    public $fillable = [
        'title',
        'slug',
    ];

    public static $rules = [
        'title' => 'required|string|min:3'
    ];
}
