<?php

namespace App\Models;

use Eloquent as Model;

class MeasureTranslation extends Model {

    public $table = 'measurement_translations';

    public static function boot() {

        parent::boot();

        static::creating( function($measurement_translations) {

            $measurement_translations->slug = str_slug($measurement_translations->title);

            $latest_slug =static::whereRaw("slug RLIKE '^{$measurement_translations->slug}(-[0-9]*)?$'")
                                    ->latest('id')
                                    ->value('slug');

            if( $latest_slug ) {

                $pieces = explode('-', $latest_slug);
                $number = intval(end($pieces));
                $measurement_translations->slug .= '-' . ($number + 1);
            }

        });
    }

    public $timestamps = false;

    public $fillable = ['title', 'title_short', 'slug'];

    public static $rules = ['title' => 'required|string|min:1', 'title_short' => 'required|string|min:1'];
}
