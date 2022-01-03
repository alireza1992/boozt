<?php

namespace App\Core;

use App\Core\Exceptions\NotFoundException;

class Router
{
    private Request $request;
    private Response $response;
    private array $routeMap = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $url, $callback)
    {
        $this->routeMap['get'][$url] = $callback;
    }


    /**
     * @return array|false|mixed|string|string[]
     * @throws NotFoundException
     */
    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routeMap[$method][$url] ?? false;
        if (!$callback) {

            throw new NotFoundException();
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {

            $controller = new $callback[0];
            $controller->action = $callback[1];
            Application::$app->controller = $controller;
            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * @param string $view
     * @param array $params
     * @return array|false|string|string[]
     */
    public function renderView(string $view, array $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

}