<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Filling;

class FillingRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Filling::$rules;}
}
