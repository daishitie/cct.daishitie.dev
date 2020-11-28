<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Session;

/**
 * Logout
 */
class LogoutController extends Controller
{
    public function index($params = [])
    {
        Session::destroy();
        $this->redirect();
    }
}
