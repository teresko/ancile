<?php

namespace Ancile\Exception;

use Ancile\Component\Exception as Exception;

class AccessDenied extends Exception
{
    protected $code = 4000;
    protected $message = 'ancile.error.access-denied';
}
