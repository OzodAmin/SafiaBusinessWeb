<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class City extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'city';

    public $translatedAttributes = [
        'title',
    ];

    protected $fillable = ['user_id'];

    public static $rules = [
        'ru.title' => 'required|string|min:3|max:255',
        'uz.title' => 'required|string|min:3|max:255',
        'en.title' => 'required|string|min:3|max:255',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($city) {
            $city->deleteTranslations();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'district_city_id', 'id');
    }
}
