<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Middlewares\CheckAccessMiddleware;

class GalleryController extends Controller
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $gallery = $this->queryBuilder->table('gallery')->getAll()->execute();

        if(!$gallery) return $this->sendResponse(data: $gallery, message: "لیست عکس ها خالی است" , error: true, status: HTTP_BadREQUEST);

        return $this->sendResponse(data: $gallery, message: "لیست عکس ها با موفقیت گرفته شد");
    }

    public function get($id){
        $gallery = $this->queryBuilder->table('gallery')
            ->where(value: $id)
            ->get()->execute();

        if(!$gallery) return $this->sendResponse(data: $gallery, message: "عکس پیدا نشد" , error: true, status: HTTP_NotFOUND);
        return $this->sendResponse(data: $gallery, message: "اطلاعات عکس با موفقیت گرفته شد");
    }

    public function store($request){
        // validate request
        $this->validate([
            'title||required|min:3|max:100|string',
            'img_link||required|min:6|max:255|string',
        ], $request);

        $this->checkUnique(table: 'gallery' ,array: [['img_link', $request->img_link]]);

        $newimg = $this->queryBuilder->table('gallery')
            ->insert([
                'title' => $request->title,
                'img_link' => $request->img_link
            ])->execute();

        return $this->sendResponse(data: $newimg, message: "عکس شما با موفقیت ایجاد شد!");
    }

    public function update($id, $request){
        $this->validate([
            'title||required|min:3|max:100|string',
            'img_link||required|min:6|max:255|string',
        ], $request);

        $getgallery = $this->queryBuilder->table('gallery')
            ->where(value:$id)->get()->execute();
        if(!$getgallery) return $this->sendResponse(data:$getgallery , message: "عکس یافت نشد" , error: true, status: HTTP_NotFOUND);


        $updatedgallery = $this->queryBuilder->table('gallery')
            ->update([
                'title' => $request->title,
                'img_link' => $request->img_link
            ])->where(value: $id)
            ->execute();

        return $this->sendResponse(data:$updatedgallery, message: "عکس با موفقیت ویرایش شد");
    }

    public function destroy($id){

        $getgallery = $this->queryBuilder->table('gallery')
            ->where(value:$id)->get()->execute();
        if(!$getgallery) return $this->sendResponse(data:$getgallery , message: "عکس یافت نشد" , error: true, status: HTTP_NotFOUND);

        $deletegallery = $this->queryBuilder->table('gallery')
            ->delete()->where(value: $id)
            ->execute();

        return $this->sendResponse(data: $deletegallery , message: "عکس با موفقیت حذف شد");
    }
}