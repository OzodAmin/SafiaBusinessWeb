<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Models\City;
use App\Models\District;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable;
    use HasApiTokens;
    use EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'password', 'sex', 'dob', 'companyName', 'mobile', 'phone', 'cityId', 'districtId', 'address', 'legal_name', 'discount'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules =[
            'name' => 'required|max:255',
            'legal_name' => 'required|max:255',
            'discount' => 'integer|required',
            'email' => 'required|email|max:255|unique:users',
            'sex' => 'required',
            'dob' => 'required',
            'companyName' => 'required', 
            'mobile' => 'required', 
            'phone' => 'required', 
            'cityId' => 'required', 
            'districtId' => 'required', 
            'address' => 'required'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'cityId', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'districtId', 'id');
    }
}
