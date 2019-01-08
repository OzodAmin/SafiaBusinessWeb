<?php

namespace App\Models;

use App\Models\Product;
use Eloquent as Model;
use App\User;

class Order extends Model {

	const NEW_ORDER = '1';
    const ACCEPTED_ORDER = '2';
    const DECLINED_ORDER = '3';
  
    public $table = 'orders';

    protected $fillable = ['user_id', 'total_price', 'status', 'note', 'prefered_time'];

    protected $casts = ['user_id' => 'integer', 'status' => 'integer'];

    public static $rules = ['prefered_time' => 'required|string'];

    public function user(){return $this->belongsTo(User::class, 'user_id', 'id');}
    public function products(){return $this->belongsToMany(Product::class)->withPivot('quantity');}
}
