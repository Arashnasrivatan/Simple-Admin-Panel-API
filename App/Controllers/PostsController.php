<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Middlewares\CheckAccessMiddleware;

class PostsController extends Controller
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $posts = $this->queryBuilder->table('posts')->getAll()->execute();

        if(!$posts) return $this->sendResponse(data: $posts, message: "لیست پست ها خالی است" , error: true, status: HTTP_BadREQUEST);

        return $this->sendResponse(data: $posts, message: "لیست پست ها با موفقیت گرفته شد");
    }

    public function get($id){
        $post = $this->queryBuilder->table('posts')
            ->where(value: $id)
            ->get()->execute();

        if(!$post) return $this->sendResponse(data: $post, message: "پست پیدا نشد" , error: true, status: HTTP_NotFOUND);
        return $this->sendResponse(data: $post, message: "پست با موفقیت گرفته شد");
    }

    public function store($request){
        // validate request
        $this->validate([
            'user_id||required|number',
            'title||required|min:3|max:75|string',
            'text||required|min:10|max:250|string',
        ], $request);

        $getuser = $this->queryBuilder->table('users')
            ->where('id', '=', $request->user_id)
            ->where('role', '=', 'User')->get()->execute();
        if(!$getuser) return $this->sendResponse(message: "ایدی کاربر وجود ندارد", error: true, status: HTTP_BadREQUEST);

        $newpost = $this->queryBuilder->table('posts')
            ->insert([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'text' => $request->text,
            ])->execute();

        return $this->sendResponse(data: $newpost, message: "پست شما با موفقیت ایجاد شد!");
    }

    public function update($id, $request){
        $this->validate([
            'title||required|min:3|max:75|string',
            'text||required|min:10|max:250|string',
        ], $request);

        $getpost = $this->queryBuilder->table('posts')
            ->where(value:$id)->get()->execute();
        if(!$getpost) return $this->sendResponse(data:$getpost , message: "پست یافت نشد" , error: true, status: HTTP_NotFOUND);


        $updatedpost = $this->queryBuilder->table('posts')
            ->update([
                'title' => $request->title,
                'text' => $request->text,
            ])->where(value: $id)
            ->execute();

        return $this->sendResponse(data:$updatedpost , message: "پست با موفقیت ویرایش شد");
    }

    public function destroy($id){

        $getpost = $this->queryBuilder->table('posts')
            ->where(value:$id)->get()->execute();
        if(!$getpost) return $this->sendResponse(data:$getpost , message: "پست یافت نشد" , error: true, status: HTTP_NotFOUND);


        $deletepost = $this->queryBuilder->table('posts')
            ->delete()->where(value: $id)
            ->execute();

        return $this->sendResponse(data: $deletepost , message: "پست با موفقیت حذف شد");
    }
}