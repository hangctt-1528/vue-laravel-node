<?php

namespace App\Services;

use App\Repositories\ItemRepositoryInterface;
 
class ItemService extends AppService
{
    public function __construct(ItemRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

     public function getList()
    {
    	return $this->repository->getList();
    }
}
