<?php

namespace Covid\App\Models;

use Covid\App\Libraries\Database;

class Alert
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $this->db
            ->query("SELECT
                    alerts.*,
                    alert_types.type
                FROM alerts
                LEFT JOIN alert_types
                ON alerts.type_id = alert_types.id
            ");

        return $this->db->findAll() ?? false;
    }

    public function getDashboard()
    {
        $this->db
            ->query("SELECT *
                FROM alerts
                LEFT JOIN alert_types
                ON alert_types.id = alerts.type_id
                WHERE alerts.in_dashboard = true
                ORDER BY updated_at DESC
            ");

        return $this->db->findAll() ?? false;
    }

    public function getById($id)
    {
        $this->db
            ->query("SELECT *
                FROM alerts
                WHERE alerts.id = :id
            ");

        $this->db->bind(':id', $id);
        return $this->db->find() ?? false;
    }

    public function store($alert)
    {
        $now = date('Y-m-d H:i:s');

        $this->db
            ->query("INSERT
                INTO alerts (type_id,message,in_dashboard,created_at,updated_at)
                VALUES (:type,:message,:in_dashboard,:created_at,:updated_at)
            ");

        $this->db->bind(':type', $alert['type']);
        $this->db->bind(':message', $alert['message']);
        $this->db->bind(':in_dashboard', $alert['in_dashboard']);
        $this->db->bind(':created_at', $now);
        $this->db->bind(':updated_at', $now);
        return $this->db->execute();
    }

    public function update($alert)
    {
        $now = date('Y-m-d H:i:s');

        $this->db
            ->query("UPDATE alerts
                SET 
                    type_id = :type,
                    message = :message,
                    in_dashboard = :in_dashboard,
                    updated_at = :updated_at
                WHERE id = :id
            ");

        $this->db->bind(':id', $alert['alert_id']);
        $this->db->bind(':type', $alert['type']);
        $this->db->bind(':message', $alert['message']);
        $this->db->bind(':in_dashboard', $alert['in_dashboard']);
        $this->db->bind(':updated_at', $now);
        return $this->db->execute();
    }

    public function destroy($data)
    {
        $this->db->query("DELETE FROM alerts WHERE id = :id");
        $this->db->bind(':id', $data['alert_id']);
        return $this->db->execute();
    }
}
