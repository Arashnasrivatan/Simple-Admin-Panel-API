<?php
namespace App\Middlewares;

use App\Auth\JWTAuth;
use App\Traits\ResponseTrait;

class AuthMiddleware {
    use JWTAuth;
    use ResponseTrait;

    public function handle($request) {
        // Check if the request path is public

        if ($this->isPublicPath(getPath())) {
            return true; // Allow public paths
        }

        // Check if the request has a JWT token
        $token = $this->getTokenFromRequest($request);
        if (!$token) {
            $this->sendResponse(null, "Unauthorized!", true, 401);
            return exit();
        }

        // Verify the JWT token
//        dd($this->verifyToken($token));
        if (!$this->verifyToken($token)) {
            $this->sendResponse(null, "Unauthorized Token!", true, 401);
            return exit();
        }

        return true;
    }

    private function isPublicPath($path) {
        // Define public paths
        $publicPaths = ['v1/login']; // Add more public paths if needed

        // Check if the requested path is public
        return in_array($path, $publicPaths);
    }

    private function getTokenFromRequest($request) {
        // Get token from headers, query string, or request body
        $token = $request->headers ?? $request->query ?? $request->body ?? null;
        return $token;
    }
}
