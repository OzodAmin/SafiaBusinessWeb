<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class CategoryRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Category::$rules;}
}
