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
            ->query("SELECT 
                    patients.*,
                    gender.gender,
                    status.status
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

    public function showCity()
    {
        $this->db
            ->query("SELECT
                city
                FROM patients
                GROUP BY city
                ORDER BY city
            ");

        return $this->db->findAll();
    }

    public function countCity($city, $status)
    {
        $this->db
            ->query("SELECT *
                FROM patients
                LEFT JOIN status
                ON patients.status_id = status.id
                WHERE patients.city = :city
                AND status.status = :status
            ");

        $this->db->bind(':city', $city);
        $this->db->bind(':status', $status);
        return $this->db->rowCount() ?? 0;
    }

    public function countStatus($status)
    {
        $this->db
            ->query("SELECT *
                FROM patients
                LEFT JOIN status
                ON patients.status_id = status.id
                WHERE status.status = :status    
            ");

        $this->db->bind(':status', $status);
        return $this->db->rowCount() ?? 0;
    }

    public function countGender($gender)
    {
        $this->db
            ->query("SELECT *
                FROM patients
                LEFT JOIN gender
                ON patients.gender_id = gender.id
                WHERE gender.gender = :gender
            ");

        $this->db->bind(':gender', $gender);
        return $this->db->rowCount() ?? 0;
    }
}
