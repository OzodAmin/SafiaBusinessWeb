<?php

namespace App\Models;

use Eloquent as Model;

class ProductTranslation extends Model {

    public $table = 'product_translations';

    public static function boot() {

        parent::boot();

        static::creating( function($product_translations) {

            $product_translations->slug = str_slug($product_translations->title);

            $latest_slug =static::whereRaw("slug RLIKE '^{$product_translations->slug}(-[0-9]*)?$'")
                                    ->latest('id')
                                    ->value('slug');

            if( $latest_slug ) {
                $pieces = explode('-', $latest_slug);
                $number = intval(end($pieces));
                $product_translations->slug .= '-' . ($number + 1);
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
