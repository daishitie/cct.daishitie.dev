<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Csrf;
use Covid\App\Libraries\Session;
use Covid\App\Models\User;

class UsersController extends Controller
{
    /** @var User */
    private $user;
    /** @var Record */
    private $record;
    /** @var string */
    private $csrfToken;
    /** @var int */
    private $csrfTokenExpiry;
    /** @var array */
    private $userSession;
    public function __construct()
    {
        Csrf::make();
        $this->user = $this->model('User');
        $this->csrfToken = Session::get('csrf_token');
        $this->csrfTokenExpiry = Session::get('csrf_token-expiry');

        if (Session::exists()) {
            $this->userSession = Session::getData($this->user);
        } else {
            $this->redirect();
        }
    }

    public function index()
    {
        if ($this->userSession['role_id'] == 1) {
            $this->redirect();
        }

        $this->view('users/index', [
            'title' => 'Accounts',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'accounts' => $this->user->getAll()
        ]);
    }
}
