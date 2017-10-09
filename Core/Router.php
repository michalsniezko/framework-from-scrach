<?php

namespace Core;

class Router
{

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param string $route
     * @param array $params
     * @return void
     */
    public function add(string $route, array $params = []): void
    {
        $route = preg_replace('/\//', '\\/', $route);

        //convert variables e.g. {controller} to named capture groups
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        /*
         * If the first character inside a capture group is the caret ^ , then that negates the group, in other words, anything except what appears inside the brackets.
         */

        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function match(string $url): bool
    {

        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches))
            {
                foreach ($matches as $key => $match) {
                    if(is_string($key))
                    {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;

            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $url
     * @return void
     */
    public function dispatch(string $url):void
    {

        $url = $this->removeQueryStringVariables($url);

        if($this->match($url))
        {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);

//            $controller = "App\\Controllers\\$controller";
            $controller = $this->getNamespace() . $controller;

            if(class_exists($controller))
            {
                $controllerObject = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                //check if the action doesnt end with 'Action' - this would cause a security breach, see Controller::__call
                if(preg_match('/action$/i', $action) === 0 )
                {
                    $controllerObject->$action();
                }
                else
                {
//                    echo "Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method";
                    throw new \Exception("Method $action in controller $controller not found");
                }
//                if(is_callable(array($controllerObject, $action)))
//                {
//                    $controllerObject->$action();
//                }
//                else
//                {
//                    echo "Method $action (in controller $controller) not found";
//                }
            }
            else
            {
//                echo "Controller class $controller not found";

                throw new \Exception("Controller class $controller not found");
            }
        }
        else
        {
//            echo "No route matched";
            throw new \Exception("No route matched");
        }
    }

    /**
     * @param string $string
     * @return string
     */
    protected function convertToStudlyCaps(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * @param string $string
     * @return string
     */
    protected function convertToCamelCase(string $string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function removeQueryStringVariables(string $url): string
    {
        if($url != '')
        {
            $parts = explode('&', $url, 2);

            if(strpos($parts[0], '=') === false)
            {
                $url = $parts[0];
            }
            else
            {
                $url = '';
            }
        }

        return $url;
    }

    /**
     * @return void
     */
    public function printRoutingTable(): void
    {
        echo "ROUTING TABLE:";
        echo '<pre>' . htmlspecialchars(print_r($this->routes, true)) . '</pre>';
    }

    /**
     * @return string
     */
    protected function getNamespace(): string
    {
        $namespace = 'App\Controllers\\';

        if(array_key_exists('namespace', $this->params))
        {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }
}

