<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Session;
use Covid\App\Models\User;

class UsersController extends Controller
{
    /** @var User */
    private $user;

    public function __construct()
    {
        $this->user = $this->model('User');
    }

    public function index()
    {
        $this->view('users/index', [
            'title' => 'Accounts',
            'user_session' => Session::getData($this->user)
        ]);
    }
}
