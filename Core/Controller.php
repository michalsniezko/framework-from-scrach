<?php

namespace Core;


abstract class Controller
{

    protected $route_params = [];

    /**
     * Controller constructor.
     * @param array $route_params
     */
    public function  __construct(array $route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Action filter
     *
     * @param $name
     * @param $arguments
     *
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $method = $name . 'Action';

        if(method_exists($this, $method))
        {
            if($this->before() !== false)
            {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            }
        }
        else
        {
//            echo "Method $method not found in controller " . get_class($this);
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * If this returns false, original method will not be executed
     *
     * @return mixed
     */
    protected function before()
    {

    }

    /**
     * @return void
     */
    protected function after(): void
    {

    }


}