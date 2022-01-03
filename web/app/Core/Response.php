<?php
namespace App\Core;

class Response
{
    /**
     * @param int $code
     */
    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    /**
     * @param string $url
     */
    public function redirect(string $url)
    {
        header("Location: $url");
    }
}