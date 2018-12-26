<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Size;

class SizeRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Size::$rules;}
}
