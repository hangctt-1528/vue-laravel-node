<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

abstract class ApiCollection extends ResourceCollection
{
    protected $message;

    public function __construct($resource, $message = null)
    {
        $this->message = $message;

        parent::__construct($resource);
    }

    public function with($request)
    {
        return [
            'message' => $this->message ? [$this->message] : [],
            'code' => Response::HTTP_OK,
        ];
    }
}
