<?php

namespace App\Models;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent as Model;
use App\Models\Filling;
use App\Models\Category;
use App\Models\Measure;
use App\Models\Cover;
use App\Models\Decor;
use App\Models\Cream;
use App\Models\Base;
use App\Models\Size;
use App\User;

class Product extends Model
{

    use \Dimsav\Translatable\Translatable;

    public $table = 'product';
    public $translationModel = 'App\Models\ProductTranslation';
    public $translatedAttributes = ['title','slug'];

    protected $casts = ['user_id' => 'integer'];

    protected $fillable = ['user_id', 'price', 'featured_image', 'user_id', 'category_id', 'size_id', 'is_special', 'measure_id', 'min_order'];

    public static $rules = [
        'featured_image' => 'image|max:2048',
        'category_id' => 'integer|required',
        'measure_id' => 'integer|required',
        'min_order' => 'required|numeric|min:0',
        'price' => 'integer|required',
        'ru.title' => 'required|string|min:3|max:255',
        'uz.title' => 'required|string|min:3|max:255',
        'en.title' => 'required|string|min:3|max:255',
    ];

    public function messages()
    {
        return [
            'min_order.integer' => 'A Мин заказ is numeric',
            'body.required'  => 'A message is required',
        ];
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($product) {
            $product->deleteTranslations();
        });
    }

    public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}
    public function category(){return $this->belongsTo(Category::class, 'category_id', 'id');}
    public function size(){return $this->belongsTo(Size::class, 'size_id', 'id');}
    public function measure(){return $this->belongsTo(Measure::class, 'measure_id', 'id');}

    //Many to many reltionships in pivot table
    public function bases(){return $this->belongsToMany(Base::class);}
    public function covers(){return $this->belongsToMany(Cover::class);}
    public function creams(){return $this->belongsToMany(Cream::class);}
    public function decors(){return $this->belongsToMany(Decor::class);}
    public function fillings(){return $this->belongsToMany(Filling::class);}
}
