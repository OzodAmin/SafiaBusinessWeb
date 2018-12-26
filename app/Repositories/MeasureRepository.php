<?php

namespace App\Repositories;

use App\Models\Measure;
use InfyOm\Generator\Common\BaseRepository;

class MeasureRepository extends BaseRepository
{
    protected $fieldSearchable = ['user_id'];
    public function model(){return Measure::class;}
}
