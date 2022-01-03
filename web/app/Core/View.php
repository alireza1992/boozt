<?php

namespace App\Core;

class View
{
    /**
     * @param string $view
     * @param array $params
     * @return array|false|string|string[]
     */
    public function renderView(string $view, array $params)
    {
        $layoutName = Application::$app->layout;
        if (Application::$app->controller) {
            $layoutName = Application::$app->controller->layout;
        }
        $viewContent = $this->renderViewOnly($view, $params);

        ob_start();
        include_once Application::$ROOT_DIR . "/Views/Layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * @param string $view
     * @param array $params
     * @return false|string
     */
    public function renderViewOnly(string $view, array $params): string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/Views/$view.php";
        return ob_get_clean();
    }
}