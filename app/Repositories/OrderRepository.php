<?php

namespace App\Repositories;

use App\Models\Order;
use InfyOm\Generator\Common\BaseRepository;

class OrderRepository extends BaseRepository
{
    protected $fieldSearchable = ['user_id'];
    public function model(){return Order::class;}
}
