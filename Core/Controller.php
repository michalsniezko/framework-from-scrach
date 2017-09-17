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

}