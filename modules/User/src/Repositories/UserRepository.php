<?php

namespace Modules\User\src\Repositories;

use Modules\User\src\Models\User;
use App\Repositories\BaseRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Lấy tên class model tương ứng.
     *
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

   
    // public function getUsers($limit=10)
    // {
    //     // return $this->model->limit($limit)->get();
    //     return $this->getAll();
    // }

    public function getUsers($limit){
        return $this->model->paginate($limit);
    }

    public function setPassword($password,$id){
        return $this->update($id,['password'=>Hash::make($password)]);
    }

    public function checkPassword($password, $id)
    {
        $user=$this->find($id);
        if($user){
            $hashPassword=$user->password;
            return Hash::check($password,$hashPassword);
        }
        return false;
    }
}
