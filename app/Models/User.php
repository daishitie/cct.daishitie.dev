<?php

namespace Covid\App\Models;

use Covid\App\Libraries\Database;
use Covid\App\Libraries\Session;

class User
{
    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password)
    {
        $this->db->query("SELECT
                users.id, 
                users.password
            FROM users
            WHERE username = :username
            OR email = :email
        ");

        $this->db->bind(':username', $username);
        $this->db->bind(':email', $username);

        if ($user = $this->db->find()) {
            if (password_verify($password, $user->password)) {
                return $user->id;
            }
        }

        return false;
    }

    public function register($firstname, $lastname, $username, $email, $password)
    {
        $this->db
            ->query("INSERT INTO
                users (firstname,lastname,username,email,password)
                VALUES (:firstname,:lastname,:username,:email,:password)
            ");

        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));
        return $this->db->execute();
    }

    public function findUsername($username)
    {
        $this->db->query("SELECT *
            FROM users
            WHERE username = :username
        ");

        $this->db->bind(':username', $username);
        return $this->db->find() ?? false;
    }

    public function findEmail($email)
    {
        $this->db->query("SELECT *
            FROM users
            WHERE email = :email
        ");

        $this->db->bind(':email', $email);
        return $this->db->find() ?? false;
    }

    public function getById($id)
    {
        $this->db
            ->query("SELECT 
                    users.id,
                    users.firstname,
                    users.lastname,
                    users.username,
                    users.email
                FROM users
                WHERE id = :id
            ");

        $this->db->bind(':id', $id);
        return $this->db->find() ?? false;
    }
}
