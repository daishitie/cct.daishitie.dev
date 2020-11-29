<?php

namespace Covid\App\Libraries;

class Controller
{
    /**
     * Register model and call it
     *
     * @param string $model
     */
    public function model($model = null)
    {
        if (file_exists($file = __DIR__ . '/../Models/' . $model . '.php')) {
            $model = 'Covid\\App\\Models\\' . $model;
            require_once $file;
            return new $model();
        }

        return false;
    }

    public function view($view, $data = [])
    {
        if (file_exists($file =  __DIR__ . '/../Views/' . $view . '.php')) {
            $sidebar = __DIR__ . '/../Views/layout/sidebar.php';
            $navbar = __DIR__ . '/../Views/layout/navbar.php';
            $copyright = __DIR__ . '/../Views/layout/copyright.php';

            require_once __DIR__ . '/../Views/layout/header.php';
            require_once $file;
            require_once __DIR__ . '/../Views/layout/footer.php';
            exit;
        }

        return false;
    }

    public function redirect($location = null)
    {
        return header('Location: ' . config('app.url')  . '/' . $location);
    }

    // Will check for every errors.
    public function checkErrors($data = [])
    {
        $error = false;

        foreach ($data['errors'] as $key => $value) {
            $error .= $value;
        }

        return $error;
    }

    /**
     * Data dump
     *
     * @param mixed $data
     * @return mixed
     */
    public function dump($data)
    {
        highlight_string("<?php\n " . var_export($data, true) . "?>");
        echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
        exit;
    }
}
