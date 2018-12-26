<?php

namespace App\Models;

use Eloquent as Model;

class CreamTranslation extends Model {

    public $table = 'cream_translations';

    public static function boot() {

        parent::boot();

        static::creating( function($cream_translations) {

            $cream_translations->slug = str_slug($cream_translations->title);

            $latest_slug =static::whereRaw("slug RLIKE '^{$cream_translations->slug}(-[0-9]*)?$'")
                                    ->latest('id')
                                    ->value('slug');

            if( $latest_slug ) {

                $pieces = explode('-', $latest_slug);
                $number = intval(end($pieces));

                $cream_translations->slug .= '-' . ($number + 1);
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
