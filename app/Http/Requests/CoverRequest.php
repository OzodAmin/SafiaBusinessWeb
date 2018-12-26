<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cover;

class CoverRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Cover::$rules;}
}
