<?php

namespace Modules\User\src\Http\Controllers;

use Modules\User\src\Models\User;
use App\Http\Controllers\Controller;
use DragonCode\Contracts\Cashier\Http\Request;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\User\src\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo; 
    }

    public function index()
    {
        // $users = $this->userRepo->getUsers();
        // dd($users);
        $pageTitle='List users';
        $user= $this->userRepo->getUsers(5);
        return view('user::lists',compact('pageTitle'));
    }

    public function detail($id)
    {
        $title = 'test';
        return view('user::detail', compact('title', 'id'));
    }

    public function create()
    {
        // $user = new User();
        // $user->name = 'Hoang An';
        // $user->email = 'hoan.ng@gmail.com';
        // $user->save();
        $pageTitle='Add user';
        return view('user::add',compact('pageTitle'));
    }

    public function store(UserRequest $request)
    {
        return view('user::store');
    }

    public function edit($id)
    {
        //
    }

   
}
