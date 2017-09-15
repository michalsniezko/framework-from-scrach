<?php

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


}