<?php

namespace App\Http\Resources;

class AuthResource extends ApiResource
{
    protected $method;

    public function __construct($resource, $method = 'login', $message = null)
    {
        parent::__construct($resource, $message);
        $this->method = $method;
    }

    public function toArray($request)
    {
        return $this->{$this->method}();
    }

    protected function login()
    {
        return [
            'token_type' => $this->resource['token_type'],
            'access_token' => $this->resource['access_token'],
        ];
    }
}
