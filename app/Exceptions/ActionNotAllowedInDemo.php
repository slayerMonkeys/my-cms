<?php

namespace App\Exceptions;

use Exception;

class ActionNotAllowedInDemo extends Exception
{
    protected $message = "The demo mode does not allow you to do this.";
    protected $code = 403;
}
