<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Middlewares\CheckAccessMiddleware;

class CommentsController extends Controller
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $comments = $this->queryBuilder->table('comments')->getAll()->execute();

        if(!$comments) return $this->sendResponse(data: $comments, message: "لیست نظرات ها خالی است" , error: true, status: HTTP_BadREQUEST);

        return $this->sendResponse(data: $comments, message: "لیست نظرات ها با موفقیت گرفته شد");
    }

    public function get($id){
        $comment = $this->queryBuilder->table('comments')
            ->where(value: $id)
            ->get()->execute();

        if(!$comment) return $this->sendResponse(data: $comment, message: "نظری یافت نشد" , error: true, status: HTTP_NotFOUND);
        return $this->sendResponse(data: $comment, message: "نظرات با موفقیت گرفته شد");
    }

    public function store($request){
        // validate request
        $this->validate([
            "post_id||required|number",
            "title||required|string|min:5|max:100",
            "email||required|string|min:5|max:100",
            "text||required|string|min:5|max:250",
        ], $request);

        $getpost = $this->queryBuilder->table('posts')
            ->where('id', '=', $request->post_id)->get()->execute();
        if(!$getpost) return $this->sendResponse(message: "ایدی پست وجود ندارد", error: true, status: HTTP_BadREQUEST);

        $newcomment = $this->queryBuilder->table('comments')
            ->insert([
                'post_id' => $request->post_id,
                'title' => $request->title,
                'email' => $request->email,
                'text' => $request->text,
            ])->execute();

        return $this->sendResponse(data: $newcomment, message: "نظرات شما با موفقیت ایجاد شد!");
    }

    public function update($id, $request){
        $this->validate([
            "title||required|string|min:5|max:100",
            "email||required|string|min:5|max:100",
            "text||required|string|min:5|max:250",
        ], $request);

        $getcomment = $this->queryBuilder->table('comments')
            ->where(value:$id)->get()->execute();
        if(!$getcomment) return $this->sendResponse(data:$getcomment , message: "نظری یافت نشد" , error: true, status: HTTP_NotFOUND);


        $updatedcomment = $this->queryBuilder->table('comments')
            ->update([
                'title' => $request->title,
                'email' => $request->email,
                'text' => $request->text,
            ])->where(value: $id)
            ->execute();

        return $this->sendResponse(data:$updatedcomment , message: "نظرات با موفقیت ویرایش شد");
    }

    public function destroy($id){

        $getcomment = $this->queryBuilder->table('comments')
            ->where(value:$id)->get()->execute();
        if(!$getcomment) return $this->sendResponse(data:$getcomment , message: "نظری یافت نشد" , error: true, status: HTTP_NotFOUND);


        $deletecomment = $this->queryBuilder->table('comments')
            ->delete()->where(value: $id)
            ->execute();

        return $this->sendResponse(data: $deletecomment , message: "نظرات با موفقیت حذف شد");
    }
}