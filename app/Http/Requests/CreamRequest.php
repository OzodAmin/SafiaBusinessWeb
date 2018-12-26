<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cream;

class CreamRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Cream::$rules;}
}
