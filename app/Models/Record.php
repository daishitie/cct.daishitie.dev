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

    public function index()
    {
        $this->db
            ->query("SELECT * 
                FROM patients
                LEFT JOIN gender
                ON patients.gender_id = gender.id
                LEFT JOIN status
                ON patients.status_id = status.id
            ");

        return $this->db->findAll() ?? false;
    }

    public function store($data)
    {
        $this->db
            ->query("INSERT 
                INTO patients (status_id,firstname,middlename,lastname,age,gender_id,email,mobile,city)
                VALUES (:status,:firstname,:middlename,:lastname,:age,:gender,:email,:mobile,:city)
            ");

        $this->db->bind(':status', intval($data['status']));
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':middlename', $data['middlename']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':gender', intval($data['gender']));
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':city', $data['city']);
        return $this->db->execute();
    }
}
