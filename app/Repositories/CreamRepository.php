<?php

namespace App\Repositories;

use App\Models\Cream;
use InfyOm\Generator\Common\BaseRepository;

class CreamRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cream::class;
    }
}
