<?php

namespace App\Http\Resources;

class UserResource extends ApiResource
{
    protected $method;

    public function __construct($resource, $method = 'show', $message = null)
    {
        $this->method = $method;
        parent::__construct($resource, $message);
    }

    public function store()
    {
        return [
            'data' => (bool)$this->resource,
        ];
    }
}