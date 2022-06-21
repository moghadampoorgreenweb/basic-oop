<?php

namespace Infrastructure\Route;
use Infrastructure\Request\Request;

class Route
{
    public $routes;

    public function add($method, $path, $handler)
    {
        if (is_array($handler)){
            $handler = implode('@', $handler);
        }
        
        $this->routes[$method][$path] = [
            'controller' => $handler
        ];
    }

    public function run(Request $request)
    {
        if (isset($this->routes[$request->getMethod()])){
            $currentMethodRoutes = $this->routes[$request->getMethod()];
            foreach ($currentMethodRoutes as $key => $value){
                $str = str_replace(['/', '<', '>'], ['\/', '(?<', '>[\w-]*)'], $key);
                $pattern = '/^'.$str.'$/m';
                $result = preg_match($pattern, $request->getPath(), $matches);
                foreach ($matches as $item => $itemValue){
                    if (is_int($item)){
                        unset($matches[$item]);
                    }
                }
                array_unshift($matches, $request);
                if ($result){
                    $controller = $this->routes[$request->getMethod()][$key]['controller'];
                    if (is_callable($controller)){
                        call_user_func($controller);
//                        $controller();
                        break;
                    }
                    list($controller, $action) = explode('@', $controller);
                    $controllerName = "Controller\\{$controller}";
                    $c = new $controllerName();
                    $c->{$action}(...array_values($matches));
                    break;
                }
            }
        } else {
            http_response_code(405);
            throw new \Exception('Method Not Allowed');
        }
    }

    public function get($path, $handler)
    {
        $this->add('get', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->add('post', $path, $handler);
    }

    public function put($path, $handler)
    {
        $this->add('put', $path, $handler);
    }

    public function delete($path, $handler)
    {
        $this->add('delete', $path, $handler);
    }
}