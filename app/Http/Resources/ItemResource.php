<?php

namespace App\Http\Resources;

class ItemResource extends ApiResource
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
            'data' => (bool) $this->resource,
        ];
    }

    public function index()
    {
        $memos = $this->resource->toArray();

        return $memos;
    }

    public function update()
    {
        return [
            'data' => (bool) $this->resource,
        ];
    }

    public function toArray($request)
    {
        return $this->{$this->method}();
    }
}