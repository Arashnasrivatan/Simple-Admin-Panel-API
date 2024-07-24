<?php

function translate_key($input){

    $translate_arrays = [
        "name" => "نام",
        "phone_number" => "شماره تلفن",
        "username" => "نام کاربری",
        "password" => "رمز عبور",
        "mobile_number" => "شماره موبایل",
        "display_name" => "نام مستعار",
        "role" => "نقش کاربر",
        "title" => "عنوان",
        "email" => "ایمیل",
        "city" => "شهر",
        "street" => "خیابان",
        "postal_code" => "کد پستی",
        "address" => "ادرس",
        "img_link" => "لینک تصویر",
        "user_id" => "ایدی کاربر",
        "text" => "متن",
    ];

    $isFind = false;

    foreach ($translate_arrays as $key => $value)
        if($input == $key) {
            $isFind = true;
            return $value;
        }


    if(!$isFind) return $input;
}