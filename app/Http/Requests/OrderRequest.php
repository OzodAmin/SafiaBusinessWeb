<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Order;

class OrderRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Order::$rules;}
}