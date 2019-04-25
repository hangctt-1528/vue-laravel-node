<?php

namespace App\Repositories;

use App\Models\Item;

class ItemRepository extends AppRepository implements ItemRepositoryInterface
{
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }

    public function getList()
    {
    	return $this->model->get();
    }
}
