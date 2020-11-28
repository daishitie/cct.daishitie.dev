<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Csrf;
use Covid\App\Libraries\Session;
use Covid\App\Models\User;

class HomeController extends Controller
{
    private $user;

    public function __construct()
    {
        Csrf::make();

        $this->user = $this->model('User');

        if (isset($_GET['url']) && strtolower($_GET['url']) != 'home') {
            http_response_code(404);
            $this->view('errors/404', [
                'title' => '404',
            ]);
        }
    }

    public function index()
    {
        $this->view('home/index', [
            'title' => 'Dashboard',
            'token' => Session::get('csrf_token'),
            'user_session' => Session::getData($this->user),
        ]);
    }
}
