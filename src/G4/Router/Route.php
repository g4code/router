<?php

namespace G4\Router;

class Route extends \Aura\Router\Route
{
    protected $path_override = null;

    public function __construct(
        $name          = null,
        $path          = null,
        $params        = null,
        $values        = null,
        $method        = null,
        $secure        = null,
        $routable      = true,
        $is_match      = null,
        $generate      = null,
        $name_prefix   = null,
        $path_prefix   = null,
        $path_override = null
    ) {
        parent::__construct($name, $path, $params, $values, $method, $secure, $routable, $is_match, $generate, $name_prefix, $path_prefix);
        $this->path_override = $path_override;
    }

    public function generate(array $data = null)
    {
        if(null !== $this->path_override && is_callable($this->path_override))
        {
            // use a callable to modify the path data?
            if ($this->generate) {
                $generate = $this->generate;
                $data = $generate($this, (array) $data);
            }

            return $this->path_override($data);
        }

        return parent::generate($data);
    }

}
