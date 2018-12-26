<?php

namespace App\Repositories;

use App\Models\Decor;
use InfyOm\Generator\Common\BaseRepository;

class DecorRepository extends BaseRepository
{
    protected $fieldSearchable = ['user_id'];
    public function model(){return Decor::class;}
}
