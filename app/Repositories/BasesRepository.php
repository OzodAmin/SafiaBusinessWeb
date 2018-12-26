<?php

namespace App\Repositories;

use App\Models\Base;
use InfyOm\Generator\Common\BaseRepository;

class BasesRepository extends BaseRepository
{
    protected $fieldSearchable = ['user_id'];
    public function model(){return Base::class;}
}
