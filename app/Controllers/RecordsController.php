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
            'user_session' => $this->userSession,
            'patients' => $this->record->index()
        ]);
    }

    public function create($params = [])
    {
        if ($this->userSession['role_id'] == 1) {
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

    public function edit($params = [])
    {
        if ($this->userSession['role_id'] == 1) {
            $this->redirect('records');
        }

        if (!$params) {
            return $this->redirect('records');
        }

        $patientId = $params[2];

        if (!$this->record->getById($patientId)) {
            return $this->redirect('records');
        }

        $patient = $this->record->getById($patientId);

        // Initialize default data.
        $data = [
            'title' => 'Edit Record',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'patient_id' => $patient->id,
            'status' => $patient->status_id,
            'firstname' => $patient->firstname,
            'middlename' => $patient->middlename,
            'lastname' => $patient->lastname,
            'email' => $patient->email,
            'mobile' => $patient->mobile,
            'age' => $patient->age,
            'city' => $patient->city,
            'gender' => $patient->gender_id,
            'hassuccess' => false,
            'success' => '',
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

            // Check account password of current logged in user
            if (!$this->user->login($this->userSession['username'], $_POST['password_session'])) {
                $data['haserror'] = true;
                $data['errors']['db'] = 'Invalid credentials.';

                return $this->view('records/edit', $data);
            }

            $except = ['middlename', 'email', 'hassuccess', 'success', 'haserror'];

            foreach ($data as $key => $value) {
                if (!is_array($data[$key])) {
                    $data[$key] = $_POST[$key] ?? $data[$key];

                    if (empty($data[$key]) && !in_array($key, $except)) {
                        $data['errors'][$key] = ucwords($key) . ' is required.';
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
                if ($this->record->update($data)) {
                    $data['hassuccess'] = true;
                    $data['success'] = 'Record has been updated!';
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

        $this->view('records/edit', $data);
    }

    public function destroy($params = [])
    {
        if ($this->userSession['role_id'] == 1) {
            $this->redirect();
        }

        if (!$params) {
            return $this->redirect('records');
        }

        $patientId = $params[2];

        if (!$this->record->getById($patientId)) {
            return $this->redirect('records');
        }

        $patient = $this->record->getById($patientId);

        $data = [
            'title' => 'Delete Record',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'patient_id' => $patientId,
            'patient_name' => "{$patient->lastname}, {$patient->firstname} {$patient->middlename}",
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

                return $this->view('records/destroy', $data);
            }

            if (!$this->checkErrors($data)) {
                if ($this->record->destroy($data)) {
                    $data['hassuccess'] = true;
                    $data['success'] = 'Record has been deleted!';
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

        return $this->view('records/destroy', $data);
    }
}
