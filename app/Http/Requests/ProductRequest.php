<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class ProductRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Product::$rules;}
}