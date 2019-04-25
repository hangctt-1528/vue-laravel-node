<?php

namespace App\Repositories;

interface AppRepositoryInterface
{
    public function getModel();

    /**
     * @param array $columns
     * @param int $offset
     *
     * @return \Illuminate\Support\Collection
     */
    public function fetchList(array $columns = ['*'], $offset = 0);

    /**
     * @param $id
     * @param array $columns
     *
     * @return object|null
     */
    public function findById($id, array $columns = ['*']);

    /**
     * @param array $data
     *
     * @return int
     */
    public function store(array $data);

    /**
     * @param $id
     * @param array $data
     *
     * @return int
     */
    public function update($id, array $data);

    /**
     * @param array $data
     *
     * @return boolean
     */
    public function delete(array $data);

    /**
     * @param array $columns
     *
     * @return boolean
     */
    public function fetchAll(array $columns = ['*']);


    public function insert(array $data);

    /**
     * @param array $ids
     * @param array $columns
     * @param string $orderBy
     * @param string $orderDes
     *
     * @return mixed
     */
    public function getListByIds(array $ids, $columns = ['*'], $orderBy = 'id', $orderDes = 'ASC');
}
