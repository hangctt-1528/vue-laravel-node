<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class UserService extends AppService
{
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

}
