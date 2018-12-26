<?php

namespace App\Repositories;

use App\Models\Product;
use InfyOm\Generator\Common\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = ['user_id'];
    public function model(){return Product::class;}
}
