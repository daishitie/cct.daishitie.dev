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

    public function edit($params = [])
    {
        if ($this->userSession['role_id'] == 1) {
            $this->redirect();
        }

        if (!$params) {
            return $this->redirect('users');
        }

        $accountId = $params[2];

        if (!$this->user->getById($accountId)) {
            return $this->redirect('users');
        }

        $user = $this->user->getById($accountId);

        $data = [
            'title' => 'Edit Account',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'user_id' => $accountId,
            'role' => $user->role_id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'username' => $user->username,
            'email' => $user->email,
            'password' => '',
            'hassuccess' => false,
            'success' => '',
            'haserror' => false,
            'errors' => [
                'db' => '',
                'role' => '',
                'firstname' => '',
                'lastname' => '',
                'username' => '',
                'email' => '',
                'password' => '',
            ],
        ];

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Check account password of current logged in user
            if (!$this->user->login($this->userSession['username'], $_POST['password_session'])) {
                $data['haserror'] = true;
                $data['errors']['db'] = 'Invalid credentials.';

                return $this->view('users/edit', $data);
            }

            $except = ['password', 'hassuccess', 'success', 'haserror'];

            foreach ($data as $key => $value) {
                if (!is_array($data[$key])) {
                    $data[$key] = $_POST[$key] ?? $data[$key];

                    if (empty($data[$key]) && !in_array($key, $except)) {
                        $data['errors'][$key] = ucwords($key) . ' is required.';
                    }
                }
            }

            // Role
            if (!empty($data['role']) && ($data['role'] < 1 || $data['role'] > 2)) {
                $data['errors']['role'] = 'Role must be valid.';
            }

            // Username
            if (!preg_match(config('regex.username'), $data['username'])) {
                $data['errors']['username'] = 'Username can only contain letters and numbers.';
            } else {
                if ($user->username != $data['username']) {
                    if ($this->user->findUsername($data['username'])) {
                        $data['errors']['username'] = 'Username already taken.';
                    }
                }
            }

            // Email
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = 'Invalid email address format.';
            } else {
                if ($user->email != $data['email']) {
                    if ($this->user->findEmail($data['email'])) {
                        $data['errors']['email'] = 'Email already taken.';
                    }
                }
            }

            // Password
            if (!empty($data['password']) && strlen($data['password']) < 8) {
                $data['errors']['password'] = 'Password must be at least 8 characters.';
            }

            if (!$this->checkErrors($data)) {
                if ($this->user->update($data)) {
                    $data['hassuccess'] = true;
                    $data['success'] = 'Account has been updated!';
                } else {
                    $data['haserror'] = true;
                    $data['errors']['db'] = 'Internal server error.';
                }
            } else {
                // Check errors
                foreach ($data['errors'] as $value) {
                    if (!empty($value)) {
                        $data['haserror'] = true;
                    }
                }
            }
        }

        return $this->view('users/edit', $data);
    }

    public function destroy($params = [])
    {
        if ($this->userSession['role_id'] == 1) {
            $this->redirect();
        }

        if (!$params) {
            return $this->redirect('users');
        }

        $accountId = $params[2];

        if (!$this->user->getById($accountId)) {
            return $this->redirect('users');
        }

        // $user = $this->user->getById($accountId);

        $data = [
            'title' => 'Delete Account',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'user_id' => $accountId,
            'hassuccess' => false,
            'success' => '',
            'haserror' => false,
            'errors' => [
                'db' => '',
            ],
        ];

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Check account password of current logged in user
            if (!$this->user->login($this->userSession['username'], $_POST['password_session'])) {
                $data['haserror'] = true;
                $data['errors']['db'] = 'Invalid credentials.';

                return $this->view('users/destroy', $data);
            }

            if (!$this->checkErrors($data)) {
                if ($this->user->destroy($data)) {
                    $data['hassuccess'] = true;
                    $data['success'] = 'Account has been deleted!';
                } else {
                    $data['haserror'] = true;
                    $data['errors']['db'] = 'Something went wrong';
                }
            } else {
                // Check errors
                foreach ($data['errors'] as $value) {
                    if (!empty($value)) {
                        $data['haserror'] = true;
                    }
                }
            }
        }

        return $this->view('users/destroy', $data);
    }
}
