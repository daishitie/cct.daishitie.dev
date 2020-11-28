<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Csrf;
use Covid\App\Libraries\Session;

class RegisterController extends Controller
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

        if (count($params) >= 1 || time() >= Session::get('csrf-token-expiry')) {
            $this->redirect('register');
        }

        // Initialize default data.
        $data = [
            'title' => 'Register',
            'token' => Session::get('csrf-token'),
            'firstname' => '',
            'lastname' => '',
            'username' => '',
            'email' => '',
            'password' => '',
            'repeatpassword' => '',
            'haserror' => false,
            'errors' => [
                'firstname' => '',
                'lastname' => '',
                'username' => '',
                'email' => '',
                'password' => '',
                'repeatpassword' => '',
            ],
        ];

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['firstname'] = $_POST['firstname'] ?? '';
            $data['lastname'] = $_POST['lastname'] ?? '';
            $data['username'] = $_POST['username'] ?? '';
            $data['email'] = $_POST['email'] ?? '';
            $data['password'] = $_POST['password'] ?? '';
            $data['repeatpassword'] = $_POST['repeatpassword'] ?? '';

            // First name
            if (empty($data['firstname'])) {
                $data['errors']['firstname'] = 'First Name is required.';
            }

            // Last name
            if (empty($data['lastname'])) {
                $data['errors']['lastname'] = 'Last Name is required.';
            }

            // Username
            if (empty($data['username'])) {
                $data['errors']['username'] = 'Username is required.';
            } elseif (!preg_match(config('regex.username'), $data['username'])) {
                $data['errors']['username'] = 'Username can only contain letters and numbers.';
            } else {
                if ($this->user->findUsername($data['username'])) {
                    $data['errors']['username'] = 'Username already taken.';
                }
            }

            // Email
            $data['email_provider'] = explode('@', $data['email']);
            $data['email_provider'] = end($data['email_provider']);

            if (empty($data['email'])) {
                $data['errors']['email'] = 'Email is required.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = 'Invalid email address format.';
            } elseif (!in_array($data['email_provider'], config('provider.allowed'))) {
                $data['errors']['email'] = 'Email not allowed. <i><small>(ex.: @gmail.com, @yahoo.com)</small></i>';
            } elseif ($this->user->findEmail($data['email'])) {
                $data['errors']['email'] = 'Email already taken.';
            }

            // Password
            if (empty($data['password'])) {
                $data['errors']['password'] = 'Password must not be empty.';
            } elseif (strlen($data['password']) < 8) {
                $data['errors']['password'] = 'Password must be at least 8 characters.';
            }

            // Password
            if (empty($data['repeatpassword'])) {
                $data['errors']['repeatpassword'] = 'Repeat password must not be empty.';
            } elseif ($data['password'] != $data['repeatpassword']) {
                $data['errors']['repeatpassword'] = 'Password does not match.';
            }

            if (!$this->checkErrors($data)) {
                $this->user->register(
                    $data['firstname'],
                    $data['lastname'],
                    $data['username'],
                    $data['email'],
                    $data['password'],
                );

                return $this->redirect('login');
            }

            // Check errors
            foreach ($data['errors'] as $value) {
                if (!empty($value)) {
                    $data['haserror'] = true;
                }
            }
        }

        // Render view for register.
        return $this->view('users/register', $data);
    }
}
