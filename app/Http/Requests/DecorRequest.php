<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Decor;

class DecorRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Decor::$rules;}
}
