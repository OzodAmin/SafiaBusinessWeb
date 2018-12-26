<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Measure extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'measurement';

    public $translatedAttributes = [
        'title',
        'title_short',
        'slug',
    ];

    protected $casts = ['user_id' => 'integer'];

    protected $fillable = ['user_id'];

    public static $rules = [
        'ru.title' => 'required|string|min:1|max:255',
        'uz.title' => 'required|string|min:1|max:255',
        'en.title' => 'required|string|min:1|max:255',
        'ru.title_short' => 'required|string|min:1|max:255',
        'uz.title_short' => 'required|string|min:1|max:255',
        'en.title_short' => 'required|string|min:1|max:255',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($category) {
            $category->deleteTranslations();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'product_category_id', 'id');
    // }
}
