<?php

namespace G4\Router;

class RouteFactory extends \Aura\Router\RouteFactory
{
    protected $params = [
        'name'          => null,
        'path'          => null,
        'params'        => null,
        'values'        => null,
        'method'        => null,
        'secure'        => null,
        'routable'      => true,
        'is_match'      => null,
        'generate'      => null,
        'name_prefix'   => null,
        'path_prefix'   => null,
        'path_override' => null,
    ];

    public function newInstance(array $params)
    {
        $params = array_merge($this->params, $params);
        return new Route(
            $params['name'],
            $params['path'],
            $params['params'],
            $params['values'],
            $params['method'],
            $params['secure'],
            $params['routable'],
            $params['is_match'],
            $params['generate'],
            $params['name_prefix'],
            $params['path_prefix'],
            $params['path_override']
        );
    }
}
