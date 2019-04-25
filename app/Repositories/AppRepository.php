<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class AppRepository implements AppRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param array $columns
     * @param int $offset
     *
     * @return \Illuminate\Support\Collection
     */
    public function fetchList(array $columns = ['*'], $offset = 0)
    {
        $perPage = config('common.item_per_page');

        return $this->model
            ->skip($offset)
            ->limit($perPage)
            ->get($columns);
    }

    /**
     * @param $id
     * @param array $columns
     *
     * @return object|null
     */
    public function findById($id, array $columns = ['*'])
    {
        return $this->model
            ->find($id, $columns);
    }

    /**
     * @param array $data
     *
     * @return int
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param array $data
     *
     * @return int
     */
    public function update($id, array $data)
    {
        return $this->model
            ->where('id', $id)
            ->update($data);
    }

    /**
     * @param array $data
     *
     * @return boolean
     */
    public function delete(array $data)
    {
        return $this->model
            ->whereIn('id', $data)
            ->delete();
    }

    /**
     * @param array $columns
     *
     * @return boolean
     */
    public function fetchAll(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function getListByIds(array $ids, $columns = ['*'], $orderBy = 'id', $orderDes = 'ASC')
    {
        return $this->model->whereIn('id', $ids)
            ->orderBy($orderBy, $orderDes)
            ->get($columns);
    }
}
