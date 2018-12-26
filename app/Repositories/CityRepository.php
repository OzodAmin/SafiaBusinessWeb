<?php

namespace App\Repositories;

use App\Models\City;
use InfyOm\Generator\Common\BaseRepository;

class CityRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id'
    ];

    public function model()
    {
        return City::class;
    }
}
