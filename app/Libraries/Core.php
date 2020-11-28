<?php

namespace Covid\App\Libraries;

class Core
{
    private $fallbackController = 'Home';
    private $fallbackMethod = 'index';

    public function __construct()
    {
        session_start();
        $url = $this->parseUrl();

        // String format controller to ucwords
        $controller = $this->fallbackController;
        if ($url) $controller = ucwords(strtolower($url[0]));

        if (file_exists(__DIR__ . '/../Controllers/' . $controller . 'Controller.php')) {
            $controller = $controller;
            unset($url[0]);
        } else {
            $controller = $this->fallbackController;
        }

        // Initialize controller
        require_once __DIR__ . '/../Controllers/' . $controller . 'Controller.php';
        $controller = 'Covid\\App\\Controllers\\' . $controller . 'Controller';
        $controller = new $controller();

        // If the method doesn't exists within the current controller 
        // set the method to the fallback method
        $method = $this->fallbackMethod;
        if (isset($url[1])) {
            if (method_exists($controller, $url[1])) {
                $method = $url[1];
                unset($url[1]);
            }
        }

        call_user_func_array(
            [$controller, $method],
            isset($url)
                ? array($url)
                : []
        );

        return true;
    }

    /**
     * Parse url parameters for bootstraping
     */
    public function parseUrl()
    {
        return isset($_GET['url'])
            ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL))
            : false;
    }
}
