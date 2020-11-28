<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Csrf;
use Covid\App\Libraries\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        Csrf::make();

        $this->user = $this->model('User');
    }

    public function index($params = [])
    {
        if (Session::exists()) {
            $this->redirect();
        }

        if (count($params) >= 1) {
            $this->redirect('login');
        }

        // Initialize default data
        $data = [
            'title' => 'Login',
            'csrf-token' => Session::get('csrf-token'),
            'username' => '',
            'password' => '',
            'haserror' => false,
            'errors' => [
                'username' => '',
                'password' => '',
            ],
        ];

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['username'] = $_POST['username'] ?? '';
            $data['password'] = $_POST['password'] ?? '';

            // Validate username.
            if (empty($data['username'])) {
                $data['errors']['username'] = 'Username must not be empty.';
            }

            // Validate password.
            if (empty($data['password'])) {
                $data['errors']['password'] = 'Password must not be empty.';
            }

            // Check if all errors are empty.
            if (!$this->checkErrors($data)) {
                $user = $this->user->login($data['username'], $data['password']);

                if ($user) {
                    Session::put(['user-id' => $user]);
                    return $this->redirect();
                }

                $data['errors']['password'] = 'Username or password is incorrect, please try again.';
            }

            // Check errors
            foreach ($data['errors'] as $value) {
                if (!empty($value)) {
                    $data['haserror'] = true;
                }
            }
        }

        $this->view('users/login', $data);
    }
}
