<?php

namespace Covid\App\Models;

use Covid\App\Libraries\Database;

class Status
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function count($status = 'confirmed')
    {
        if ($status === 'confirmed') {
            return
                $this->count('positive')
                + $this->count('recovered')
                + $this->count('deceased');
        } else {
            $this->db
                ->query("SELECT *
                    FROM patients
                    LEFT JOIN status
                    ON patients.status_id = status.id
                    WHERE status.status = :status
                ");

            $this->db->bind(':status', $status);
            return number_format($this->db->rowCount()) ?? 0;
        }
    }
}
