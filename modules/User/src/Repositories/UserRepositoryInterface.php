<?php

namespace Modules\User\src\Repositories;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Lấy danh sách người dùng.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    // public function getUsers($limit=10);
    public function getUsers($limit);
    public function setPassword($password,$id);
    public function checkPassword($password,$id);
    
}
