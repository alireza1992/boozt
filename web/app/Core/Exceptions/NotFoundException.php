<?php

namespace App\Core\Exceptions;

use App\Core\Application;
use Throwable;

class NotFoundException extends \Exception
{
    public function __construct(string $message = "Page not found", int $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        Application::$app->response->statusCode(404);
    }
}