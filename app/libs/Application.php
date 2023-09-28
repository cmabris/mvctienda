<?php

class Application
{
    private $urlController = null;
    private $urlAction = null;
    private $urlParams = [];

    public function __construct()
    {
        $url = $this->separarURL();

        if ( ! $this->urlController) {
            require_once '../app/controllers/LoginController.php';
            $page = new LoginController();
            $page->index();
        } elseif (file_exists('../app/controllers/' . ucfirst($this->urlController) . 'Controller.php')) {
            $controller = ucfirst($this->urlController) . 'Controller';
            require_once '../app/controllers/' . $controller . '.php';
            $this->urlController = new $controller;
            $this->urlController->index();
        }
    }

    public function separarURL()
    {
        if ($_SERVER['REQUEST_URI'] != '/') {
            $url = trim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->urlController = $url[0] ?? null;
            $this->urlAction = $url[1] ?? '';

            unset($url[0], $url[1]);

            $this->urlParams = array_values($url);

        }
    }

}
