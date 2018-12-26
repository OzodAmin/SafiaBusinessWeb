<?php

namespace App\Repositories;

use App\User;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id'
    ];

    public function model()
    {
        return User::class;
    }
}
