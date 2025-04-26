<?php

class Router
{
    protected string $uri;
    protected string $method;
    protected array $routes = [];
  

    public function __construct()
    {
        $this->uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function addRoute(string $method, string $pattern, string $action, array $middleware = [])
    {
        $regex = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '(?P<$1>[^/]+)', $pattern);
        $this->routes[] = [
            'method' => strtoupper($method),
            'pattern' => $pattern,
            'regex' => "#^$regex$#",
            'action' => $action,
            'middleware' => $middleware,
        ];
    }
 
    public function addGet(string $pattern, string $action, array $middleware = [])
    {
        $this->addRoute('GET', $pattern, $action, $middleware);
    }

    public function addPost(string $pattern, string $action, array $middleware = [])
    {
        $this->addRoute('POST', $pattern, $action, $middleware);
    }

    public function resolve(string $method, string $pattern, string $action, array $middleware = []){
        
    }
}
