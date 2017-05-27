<?php

namespace Ancile;

use Ancile\AccessControl;
use Ancile\Exception\AccessDenied;
use Ancile\Exception\MethodNotFound;

class Membrane
{

    private $instance;
    private $control;

    public function __construct($instance, AccessControl $control)
    {
        $this->instance = $instance;
        $this->control = $control;
    }


    public function __call($method, $arguments)
    {
        if (!$this->control->isAllowed(get_class($this->instance))) {
            throw new AccessDenied;
        }

        if (!method_exists($this->instance, $method)) {
            throw new MethodNotFound;
        }

        return call_user_func_array([$this->instance, $method], $arguments);
    }
}
