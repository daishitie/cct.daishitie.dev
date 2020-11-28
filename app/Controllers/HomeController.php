<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Csrf;
use Covid\App\Libraries\Session;
use Covid\App\Models\Record;
use Covid\App\Models\User;

class HomeController extends Controller
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
        }

        if (isset($_GET['url']) && strtolower($_GET['url']) != 'home') {
            http_response_code(404);
            $this->view('errors/404', [
                'title' => '404',
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
            'patients_confirmed' => number_format(99999999),
            'patients_negative' => number_format($this->record->countStatus('negative')),
            'patients_active' => number_format(0),
            'patients_recovered' => number_format(0),
            'patients_deceased' => number_format(0),
            'patients_male' => $this->record->countGender('male'),
            'patients_female' => $this->record->countGender('female'),
        ]);
    }
}
