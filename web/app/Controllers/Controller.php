<?php

namespace App\Controllers;

use App\Core\Application;

class Controller
{
    public string $layout = 'main';


    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }

}