<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    // Constructor để khởi tạo model
    public function __construct()
    {
        $this->setModel();
    }

    // Hàm thiết lập model sử dụng phương thức app()->make()
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    // Hàm này cần phải được implement trong class kế thừa
    abstract public function getModel();

    // Lấy tất cả dữ liệu từ model
    public function getAll()
    {
        return $this->model->all();
    }
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes=[])
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes=[])
    {
        $object = $this->find($id);
        if ($object) {
            $object->update($attributes);
            return $object;
        }
        return false;
    }

    public function delete($id)
    {
        $object = $this->find($id);
        if ($object) {
            $object->delete();
            return true;
        }
        return false;
    }
}
