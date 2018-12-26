<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Base;

class BaseRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Base::$rules;}
}
