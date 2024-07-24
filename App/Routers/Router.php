<?php

namespace App\Routers;

use App\Traits\ResponseTrait;
use App\Middlewares\CheckAccessMiddleware;

class Router {
    use ResponseTrait;
    private $routes = [];
    private $postData;
    private $access;

    public function __construct()
    {
        $this->postData =  getPostDataInput();
        $this->access = new CheckAccessMiddleware();
    }

    public function get($version, $path, $controller, $method, $access=false, $inaccess=false) {
        $path = '/' . $version . $path;
        $this->routes[$version]['GET'][$path] = ['controller' => $controller, 'method' => $method, 'request' => $this->postData, "requestMethod" => "get", "access" => $access, "inaccess"=> $inaccess];
    }

    public function post($version, $path, $controller, $method, $access=false, $inaccess=false) {
        $path = '/' . $version . $path;
        $this->routes[$version]['POST'][$path] = ['controller' => $controller, 'method' => $method, 'request' => $this->postData, "requestMethod" => "post", "access" => $access, "inaccess"=> $inaccess];
    }

    public function put($version, $path, $controller, $method, $access=false, $inaccess=false) {
        $path = '/' . $version . $path;
        $this->routes[$version]['PUT'][$path] = ['controller' => $controller, 'method' => $method, 'request' => $this->postData, "requestMethod" => "put", "access" => $access, "inaccess"=> $inaccess];
    }

    public function delete($version, $path, $controller, $method, $access=false, $inaccess=false) {
        $path = '/' . $version . $path;
        $this->routes[$version]['DELETE'][$path] = ['controller' => $controller, 'method' => $method, 'request' => '', "requestMethod" => "delete", "access" => $access, "inaccess"=> $inaccess];
    }

    public function resolve($version, $requestMethod, $path) {
        $path = '/' . $version . '/' . $path;
        $matchedRoute = null;

        // Match routes with variable patterns
        foreach ($this->routes[$version][$requestMethod] as $routePath => $route) {
            if ($this->isVariablePattern($routePath)) {
                $pattern = $this->getPatternFromRoute($routePath);
                if (preg_match($pattern, $path, $matches)) {
                    $matchedRoute = $route;
                    break;
                }
            } elseif ($routePath === $path) {
                $matchedRoute = $route;
                break;
            }
        }

        if ($matchedRoute) {
            $controller = $matchedRoute['controller'];
            $method = $matchedRoute['method'];
            $requestMethod = $matchedRoute['requestMethod'];
            $request = $matchedRoute['request'];

            $access = $matchedRoute['access'];
            $accessRole = [];

            $inaccess = $matchedRoute['inaccess'];
            $inaccessRole = [];

            if(is_array($inaccess)) $inaccessRole = $inaccess;
            else if(!$inaccess) $inaccessRole = false;
            else array_push($inaccessRole, $inaccess);

            if(is_array($access)) $accessRole = $access;
            else array_push($accessRole, $access);

            if($access){
                $this->access->checkAccess($accessRole);
            }
            elseif($inaccessRole) $this->access->checkAccess($inaccessRole, false);

            $controllerInstance = new $controller();
            if (isset($matches) && count($matches) && $requestMethod != "put") {
                if($requestMethod == 'get') $controllerInstance->$method($matches["id"], $request);
                else $controllerInstance->$method($matches["id"]);
            } else {
                if($requestMethod == 'post') $controllerInstance->$method($request);
                else if($requestMethod == 'put' && isset($matches)) $controllerInstance->$method($matches["id"], $request);
                else $controllerInstance->$method($request);
            }
            exit();
        } else {
            return $this->sendResponse(null, "Not Found", true, HTTP_NotFOUND);
        }
    }

    private function isVariablePattern($path) {
        return strpos($path, '{') !== false && strpos($path, '}') !== false;
    }

    private function getPatternFromRoute($routePath) {
        $pattern = preg_replace('/\{([^\/]+)\}/', '(?<$1>[^\/]+)', $routePath);
        return '#^' . $pattern . '$#';
    }
}
