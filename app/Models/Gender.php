<?php

namespace Covid\App\Models;

use Covid\App\Libraries\Database;

class Gender
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function count($gender)
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
