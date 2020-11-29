<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Csrf;
use Covid\App\Libraries\Session;
use Covid\App\Models\Alert;
use Covid\App\Models\User;
use stdClass;

class AlertsController extends Controller
{
    /** @var User */
    private $user;
    /** @var Alert */
    private $alert;
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
        $this->alert = $this->model('Alert');
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
        $this->view('alerts/index', [
            'title' => 'Alerts',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'alerts' => $this->alert->index()
        ]);
    }

    public function create($params = [])
    {
        // Only authorize administrator roles
        if ($this->userSession['role_id'] == 1) {
            $this->redirect('alerts');
        }

        $data = [
            'title' => 'Create Alert',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'type' => '',
            'message' => '',
            'in_dashboard' => 0,
            'haserror' => false,
            'errors' => [
                'type' => '',
                'message' => '',
            ],
        ];

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $except = ['in_dashboard', 'haserror'];

            foreach ($data as $key => $value) {
                if (!is_array($data[$key])) {
                    if (empty($data[$key])) {
                        if ($key != 'in_dashboard') {
                            $data[$key] = $_POST[$key] ?? $data[$key];
                        } else {
                            $data[$key] = isset($_POST[$key]) ? '1' : '0';
                        }

                        if (empty($data[$key]) && !in_array($key, $except)) {
                            $data['errors'][$key] = ucwords($key) . ' is required.';
                        }
                    }
                }
            }

            // Type
            if (!empty($data['type']) && ($data['type'] < 1 || $data['type'] > 7)) {
                $data['errors']['type'] = 'Type must be valid.';
            }

            // Check if all errors are empty.
            if (!$this->checkErrors($data)) {
                $alert = $this->alert->store($data);

                if ($alert) {
                    return $this->redirect('alerts');
                }
            }

            // Check errors
            foreach ($data['errors'] as $value) {
                if (!empty($value)) {
                    $data['haserror'] = true;
                }
            }
        }

        return $this->view('alerts/create', $data);
    }

    public function edit($params = [])
    {
        if ($this->userSession['role_id'] == 1) {
            $this->redirect('alerts');
        }

        if (!$params) {
            return $this->redirect('alerts');
        }

        $alertId = $params[2];

        if (!$this->alert->getById($alertId)) {
            return $this->redirect('alerts');
        }

        $alert = $this->alert->getById($alertId);

        $data = [
            'title' => 'Edit Alert',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'alert_id' => $alert->id,
            'type' => $alert->type_id,
            'message' => $alert->message,
            'in_dashboard' => $alert->in_dashboard,
            'hassuccess' => false,
            'success' => '',
            'haserror' => false,
            'errors' => [
                'type' => '',
                'message' => '',
                'in_dashboard' => '',
            ],
        ];

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $except = ['in_dashboard', 'hassuccess', 'success', 'haserror'];

            foreach ($data as $key => $value) {
                if (!is_array($data[$key])) {
                    if ($key != 'in_dashboard') {
                        $data[$key] = $_POST[$key] ?? $data[$key];
                    } else {
                        $data[$key] = isset($_POST[$key]) ? '1' : '0';
                    }

                    if (empty($data[$key]) && !in_array($key, $except)) {
                        $data['errors'][$key] = ucwords($key) . ' is required.';
                    }
                }
            }

            // Type
            if (!empty($data['type']) && ($data['type'] < 1 || $data['type'] > 7)) {
                $data['errors']['type'] = 'Type must be valid.';
            }

            // In Dashboard
            if (!empty($data['in_dashboard']) && $data['in_dashboard'] != 1) {
                $data['errors']['in_dashboard'] = 'In Dashboard must be valid.';
            }

            // Check if all errors are empty.
            if (!$this->checkErrors($data)) {
                if ($this->alert->update($data)) {
                    $data['hassuccess'] = true;
                    $data['success'] = 'Alert has been updated!';
                } else {
                    $data['haserror'] = true;
                    $data['errors']['db'] = 'Internal server error.';
                }
            }

            // Check errors
            foreach ($data['errors'] as $value) {
                if (!empty($value)) {
                    $data['haserror'] = true;
                }
            }
        }

        return $this->view('alerts/edit', $data);
    }

    public function destroy($params = [])
    {
        return 0;
    }
}
