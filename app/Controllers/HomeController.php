<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Csrf;
use Covid\App\Libraries\Session;
use Covid\App\Models\Alert;
use Covid\App\Models\Gender;
use Covid\App\Models\Record;
use Covid\App\Models\Status;
use Covid\App\Models\User;

class HomeController extends Controller
{
    /** @var User */
    private $user;
    /** @var Record */
    private $record;
    /** @var Status */
    private $status;
    /** @var Gender */
    private $gender;
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
        $this->record = $this->model('Record');
        $this->status = $this->model('Status');
        $this->gender = $this->model('Gender');
        $this->alert = $this->model('Alert');
        $this->csrfToken = Session::get('csrf_token');
        $this->csrfTokenExpiry = Session::get('csrf_token-expiry');

        if (Session::exists()) {
            $this->userSession = Session::getData($this->user);
        }

        if (isset($_GET['url']) && strtolower($_GET['url']) != 'home') {
            http_response_code(404);
            $this->view('errors/404', [
                'title' => '404',
                'user_session' => $this->userSession
            ]);
        }
    }

    public function index()
    {
        $patientsCity = '';
        foreach ($this->record->showCity() as $key => $value) {
            $patientsCity .= <<<HTML
            <tr>
                <th>{$value->city}</th>
                <td>{$this->record->countCity($value->city, 'negative')}</td>
                <td>{$this->record->countCity($value->city, 'positive')}</td>
                <td>{$this->record->countCity($value->city, 'recovered')}</td>
                <td>{$this->record->countCity($value->city, 'deceased')}</td>
            </tr>
            HTML;
        }

        $this->view('home/index', [
            'title' => 'Dashboard',
            'csrf_token' => $this->csrfToken,
            'user_session' => $this->userSession,
            'patients_city' => $patientsCity,
            'patients_confirmed' => $this->status->count(),
            'patients_negative' => $this->status->count('negative'),
            'patients_active' => $this->status->count('positive'),
            'patients_recovered' => $this->status->count('recovered'),
            'patients_deceased' => $this->status->count('deceased'),
            'patients_male' => $this->gender->count('male'),
            'patients_female' => $this->gender->count('female'),
            'alerts' => $this->alert->getDashboard(),
        ]);
    }
}
