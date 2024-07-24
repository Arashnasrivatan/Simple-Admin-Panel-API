<?php
namespace App\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

trait JWTAuth {
    private $dotenv;

    public function __construct()
    {
        $this->dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $this->dotenv->load();
    }

    public function generateToken($id, $username, $password, $email, $role)
    {
        $payload = [
            'id' => $id,
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'email' => $email,
            'exp' => time() + 604800 // Token expiration time  (1 Week)
        ];

        // Generate JWT token
        $jwt = JWT::encode($payload, $_ENV['SECRET_KEY'], 'HS256');
        return $jwt;
    }

    public function verifyToken($token)
    {
        try {
            // Decode JWT token
            $decoded = JWT::decode($token, new Key($_ENV['SECRET_KEY'], 'HS256'));

            // Return decoded payload
            return $decoded;
        } catch (\Exception $e) {
            // If token is invalid or expired, return false
            return false;
        }
    }

}