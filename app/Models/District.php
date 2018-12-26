<?php

namespace App\Models;

use App\User;
use Eloquent as Model;


class District extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $table = 'district';

    protected $dates = ['deleted_at'];

    public $translatedAttributes = [
        'title',
    ];

    public $fillable = [
        'user_id',
        'district_city_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'district_city_id' => 'integer'
        //'featured_image' => 'string'
    ];

    public static $rules = [
        'district_city_id' => 'integer|required',
        'ru.title' => 'required|string|min:3|max:255',
        'uz.title' => 'required|string|min:3|max:255',
        'en.title' => 'required|string|min:3|max:255'
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($news) {
            $news->deleteTranslations();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'district_city_id', 'id');
    }
}
