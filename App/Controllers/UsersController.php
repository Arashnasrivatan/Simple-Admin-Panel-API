<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Middlewares\CheckAccessMiddleware;

class UsersController extends Controller
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $users = $this->queryBuilder->table('users')->where("role", "=", "User")->getAll()->execute();

        if(!$users) return $this->sendResponse(data: $users, message: "لیست کاربر ها خالی است" , error: true, status: HTTP_BadREQUEST);

        return $this->sendResponse(data: $users, message: "لیست کاربر ها با موفقیت گرفته شد");
    }

    public function get($id){
        $user = $this->queryBuilder->table('users')
            ->where(value: $id)
            ->where('role', "=", "User")
            ->get()->execute();

        if(!$user) return $this->sendResponse(data: $user, message: "کاربر پیدا نشد" , error: true, status: HTTP_NotFOUND);
        return $this->sendResponse(data: $user, message: "اطلاعات کاربر با موفقیت گرفته شد");
    }

    public function store($request){
        // validate request
        $this->validate([
            'namefull||required|min:2|max:40|string',
            'username||required|min:3|max:25|string',
            'password||required|min:8|max:20|string',
            'email||required|min:10|max:50|string',
            'city||required|min:3|max:25|string',
            'street||required|min:2|max:40|string',
            'postal_code||required|number',
            'address||required|min:2|max:40|string',
        ], $request);

        $this->checkUnique(table: 'users' ,array: [['username', $request->username], ['email', $request->email]]);

        $newUser = $this->queryBuilder->table('users')
            ->insert([
                'namefull' => $request->namefull,
                'username' => $request->username,
                'password' => $request->password,
                'email' => $request->email,
                'city' => $request->city,
                'street' => $request->street,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'role' => 'User'
            ])->execute();

        return $this->sendResponse(data: $newUser, message: "حساب کاربری شما با موفقیت ایجاد شد!");
    }

    public function update($id, $request){
        $this->validate([
            'namefull||required|min:2|max:40|string',
            'username||required|min:3|max:25|string',
            'password||required|min:8|max:20|string',
            'email||required|min:10|max:50|string',
            'city||required|min:3|max:25|string',
            'street||required|min:2|max:40|string',
            'postal_code||required|number',
            'address||required|min:2|max:40|string',
        ], $request);

        $getuser = $this->queryBuilder->table('users')
            ->where(value:$id)->get()->execute();
        if(!$getuser) return $this->sendResponse(data:$getuser , message: "کاربر یافت نشد" , error: true, status: HTTP_NotFOUND);

        $updatedUser = $this->queryBuilder->table('users')
            ->update([
                'namefull' => $request->namefull,
                'username' => $request->username,
                'password' => $request->password,
                'email' => $request->email,
                'city' => $request->city,
                'street' => $request->street,
                'postal_code' => $request->postal_code,
                'address' => $request->address
            ])->where(value: $id)
            ->where("role", "=", "User")
            ->execute();

        return $this->sendResponse(data:$updatedUser , message: "کاربر با موفقیت ویرایش شد");
    }

    public function destroy($id){

        $getuser = $this->queryBuilder->table('users')
            ->where(value:$id)->get()->execute();
        if(!$getuser) return $this->sendResponse(data:$getuser , message: "کاربر یافت نشد" , error: true, status: HTTP_NotFOUND);

        $deleteuser = $this->queryBuilder->table('users')
            ->delete()->where(value: $id)
            ->where("role", "=", "User")
            ->execute();

        return $this->sendResponse(data: $deleteuser , message: "کاربر  با موفقیت حذف شد");
    }


    public function makeadmin($id, $request){

        $getuser = $this->queryBuilder->table('users')
            ->where(value:$id)->get()->execute();
        if(!$getuser) return $this->sendResponse(data:$getuser , message: "کاربر یافت نشد" , error: true, status: HTTP_NotFOUND);

        $getuserrole = $this->queryBuilder->table('users')
            ->where(value:$id)
            ->where("role", "=", "admin")
            ->get()->execute();
        if($getuserrole) return $this->sendResponse(data:null , message: "کاربر در حال حاظر ادمین هست" , error: true, status: HTTP_NotFOUND);

        $updatedUser = $this->queryBuilder->table('users')
            ->update([
                'role' => "admin",
            ])->where(value: $id)
            ->where("role", "=", "User")
            ->execute();

        return $this->sendResponse(data:$updatedUser , message: "کاربر با موفقیت ادمین شد");
    }
}