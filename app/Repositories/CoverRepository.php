<?php

namespace App\Repositories;

use App\Models\Cover;
use InfyOm\Generator\Common\BaseRepository;

class CoverRepository extends BaseRepository
{
    protected $fieldSearchable = ['user_id'];
    public function model(){return Cover::class;}
}
