<?php

namespace App\Repositories;

use App\Models\Filling;
use InfyOm\Generator\Common\BaseRepository;

class FillingRepository extends BaseRepository
{
    protected $fieldSearchable = ['user_id'];
    public function model(){return Filling::class;}
}
