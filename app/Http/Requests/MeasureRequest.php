<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Measure;

class MeasureRequest extends FormRequest{
    public function authorize(){return true;}
    public function rules(){return Measure::$rules;}
}
