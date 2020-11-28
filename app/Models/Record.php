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

    public function store($data)
    {
        $this->db
            ->query("INSERT
                INTO patients (status,firstname,middlename,lastname,age,gender,email,mobile,city)
                VALUES patients (:status,:firstname,:middlename,:lastname,:age,:gender,:email,:mobile,:city)
            ");

        $this->db->bind(':status', $data['status']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':middlename', $data['middlename']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':city', $data['city']);
        return $this->db->execute();
    }
}
