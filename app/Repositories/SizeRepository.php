<?php

namespace App\Repositories;

use App\Models\Size;
use InfyOm\Generator\Common\BaseRepository;

class SizeRepository extends BaseRepository
{
    public function model(){return Size::class;}
}
