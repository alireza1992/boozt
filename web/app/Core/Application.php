<?php

namespace App\Core;

use App\Controllers\Controller;
use App\Core\Database\Database;


class Application
{
    public static Application $app;
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public Database $db;
    public View $view;

    public function __construct(string $rootDir)
    {
        self::$ROOT_DIR = $rootDir;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db =new Database();
        $this->view = new View();
    }

    /**
     *
     */
    public function run(): void
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $this->router->renderView('_error', [
                'Exceptions' => $e,
            ]);
        }
    }


}