<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public $errorCode;
    public $errorMsg;

    public function __construct(array $errors)
    {
        $this->errorCode = $errors['CODE'];
        $this->errorMsg = $errors['MSG'];
    }
}
