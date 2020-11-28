<?php

namespace Covid\App\Controllers;

use Covid\App\Libraries\Controller;
use Covid\App\Libraries\Session;
use Covid\App\Models\User;

class RecordsController extends Controller
{
    /** @var User */
    private $user;

    public function __construct()
    {
        $this->user = $this->model('User');
    }

    public function index()
    {
        $this->view('records/index', [
            'title' => 'Records',
            'user_session' => Session::getData($this->user)
        ]);
    }

    public function create()
    {
        $this->view('records/create', [
            'title' => 'Create Record',
            'user_session' => Session::getData($this->user)
        ]);
    }
}
