<?php

namespace Ancile;

use Ancile\AccessControl;
use Ancile\Exception\AccessDenied;
use Ancile\Exception\MethodNotFound;

class Membrane
{

    private $instance;
    private $service;
    private $accountId;


    public function __construct($instance, AccessControl $service, $accountId)
    {
        $this->instance = $instance;
        $this->service = $service;
        $this->accountId = $accountId;
    }


    public function __call($method, $arguments)
    {
        if (!method_exists($this->instance, $method)) {
            throw new MethodNotFound;
        }

        $signature = get_class($this->instance) . '::' . $method;

        if (!$this->service->isAllowedForAccountId($signature, $this->accountId)) {
            throw new AccessDenied;
        }

        return call_user_func_array([$this->instance, $method], $arguments);
    }
}
