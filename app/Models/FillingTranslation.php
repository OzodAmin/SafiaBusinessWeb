<?php

namespace App\Models;

use Eloquent as Model;

class FillingTranslation extends Model {

    public $table = 'filling_translations';

    public static function boot() {

        parent::boot();

        static::creating( function($translations) {

            $translations->slug = str_slug($translations->title);

            $latest_slug =static::whereRaw("slug RLIKE '^{$translations->slug}(-[0-9]*)?$'")
                                    ->latest('id')
                                    ->value('slug');

            if( $latest_slug ) {

                $pieces = explode('-', $latest_slug);
                $number = intval(end($pieces));

                $translations->slug .= '-' . ($number + 1);
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
