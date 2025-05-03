<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Lấy tất cả bản ghi.
     */
    public function getAll();

    /**
     * Tìm một bản ghi theo ID.
     */
    public function find($id);

    /**
     * Tạo mới một bản ghi.
     */
    public function create(array $attributes = []);

    /**
     * Cập nhật bản ghi theo ID.
     */
    public function update($id, array $attributes = []);

    /**
     * Xóa bản ghi theo ID.
     */
    public function delete($id);
}
