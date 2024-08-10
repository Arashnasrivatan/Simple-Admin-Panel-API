<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Auth\JWTAuth as JWTAuth;

class AuthController extends Controller
{
    use JWTAuth;

    public function __construct()
    {
        parent::__construct();
    }

    public function register($request){
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

    public function login($request)
    {
        // validate request
        $this->validate([
            'username||required|min:3|max:25|string',
            'password||required|min:3|max:25|string',
        ], $request);

        $findUser = null;
        if(isset($request->username) && isset($request->password)) {
            $findUser = $this->queryBuilder->table('users')
                ->where('username', '=', $request->username)
                ->where('password', '=', $request->password)
                ->where('role', '=', 'admin')
                ->get()->execute();
        }

        // Example validation: check if username is 'admin' and password is 'admin123'
        if ($findUser) {
            // Generate JWT token
            $token = $this->generateToken(
                $findUser->id,
                $findUser->username,
                $findUser->password,
                $findUser->email,
                $findUser->role,
            );

            // Return token as JSON response
            return $this->sendResponse(data: ['token' => $token], message: "با موفقیت وارد شدید");
        } else {
            // If credentials are not valid, return error response
            return $this->sendResponse(message: "نام کاربری یا رمز عبور شما صحیح نیست!", error: true, status:  HTTP_Unauthorized);
        }
    }
}