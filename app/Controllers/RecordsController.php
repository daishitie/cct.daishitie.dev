<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Csrf;
use Covid\App\Libraries\Session;
use Covid\App\Models\Record;
use Covid\App\Models\User;

class RecordsController extends Controller
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
        $this->record = $this->model('Record');
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
        $this->view('records/index', [
            'title' => 'Records',
            'user_session' => $this->userSession
        ]);
    }

    public function create($params = [])
    {
        if ($this->userSession['role'] == 0) {
            $this->redirect('records');
        }

        if (count($params) >= 1 || time() >= Session::get('csrf_token-expiry')) {
            $this->redirect('register');
        }

        // Initialize default data.
        $data = [
            'title' => 'Create Record',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'status' => '',
            'firstname' => '',
            'middlename' => '',
            'lastname' => '',
            'email' => '',
            'mobile' => '',
            'age' => '',
            'city' => '',
            'gender' => '',
            'haserror' => false,
            'errors' => [
                'status' => '',
                'firstname' => '',
                'middlename' => '',
                'lastname' => '',
                'email' => '',
                'mobile' => '',
                'age' => '',
                'city' => '',
                'gender' => '',
            ],
        ];

        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $except = ['middlename', 'email', 'haserror'];

            foreach ($data as $key => $value) {
                if (!is_array($data[$key])) {
                    if (empty($data[$key])) {
                        $data[$key] = $_POST[$key] ?? '';

                        if (empty($data[$key]) && !in_array($key, $except)) {
                            $data['errors'][$key] = ucwords($key) . ' is required.';
                        }
                    }
                }
            }

            // Status
            if (!empty($data['status']) && ($data['status'] < 1 || $data['status'] > 4)) {
                $data['errors']['status'] = 'Status must be valid.';
            }

            // Gender
            if (!empty($data['gender']) && ($data['gender'] < 1 || $data['gender'] > 3)) {
                $data['errors']['gender'] = 'Gender must be valid.';
            }

            // Check if all errors are empty.
            if (!$this->checkErrors($data)) {
                $record = $this->record->store($data);

                if ($record) {
                    return $this->redirect('records');
                }
            }

            // Check errors
            foreach ($data['errors'] as $value) {
                if (!empty($value)) {
                    $data['haserror'] = true;
                }
            }
        }

        $this->view('records/create', $data);
    }
}
