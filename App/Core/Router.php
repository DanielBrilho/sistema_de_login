<?php
namespace App\Core;
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


    public function dispatch()
    {
        foreach ($this->routes as $route) {
            if ($this->method !== $route['method']) {
                continue;
            }

            if (preg_match($route['regex'], $this->uri, $matches)) {
                $params = array_filter(
                    $matches,
                    fn($key) => is_string($key),
                    ARRAY_FILTER_USE_KEY
                );


                [$controllerName, $methodName] = explode('@', $route['action']);
                $controllerClass = "App\\Controllers\\$controllerName"; // Updated namespace

                if (!class_exists($controllerClass)) {
                    throw new \Exception("Controller $controllerClass not found");
                }

                // Dynamically resolve constructor arguments
                $constructorParams = [];
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $reflectionClass = new \ReflectionClass($controllerClass);
                    $constructor = $reflectionClass->getConstructor();
                    $expectedParams = $constructor ? $constructor->getParameters() : [];

                    // Filter $_POST to only include expected parameters
                    foreach ($expectedParams as $param) {
                        $paramName = $param->getName();
                        if (isset($_POST[$paramName])) {
                            $constructorParams[$paramName] = $_POST[$paramName];
                        }
                    }
                } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $constructorParams = $_GET;
                }

                $reflectionClass = new \ReflectionClass($controllerClass);
                $controller = $reflectionClass->newInstanceArgs($constructorParams);

                if (!method_exists($controller, $methodName)) {
                    throw new \Exception("Method $methodName not found in controller $controllerClass");
                }

                call_user_func_array([$controller, $methodName], $params);

                return;
            }


        }
        //http_response_code(404);
        // http_response_code(404);
        // echo "404 Not Found";
    }
}

