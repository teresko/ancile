<?php

namespace Ancile\Exception;

use Ancile\Component\Exception as Exception;

class MethodNotFound extends Exception
{
    protected $code = 4001;
    protected $message = 'ancile.error.method-not-found';
}
