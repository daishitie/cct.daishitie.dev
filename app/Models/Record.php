<?php

namespace Covid\App\Models;

use Covid\App\Libraries\Database;
use Covid\App\Libraries\Session;

class Record
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function store()
    {
        // var_dump('ok');
        return true;
    }
}
