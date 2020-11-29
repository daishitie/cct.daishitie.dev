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
            ->query("INSERT
                INTO users (firstname,lastname,username,email,password)
                VALUES (:firstname,:lastname,:username,:email,:password)
            ");

        $this->db->bind(':firstname', $firstname);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));
        return $this->db->execute();
    }

    public function update($data)
    {
        if (empty($data['password'])) {
            $this->db
                ->query("UPDATE users
                SET
                    role_id = :role,
                    firstname = :firstname,
                    lastname = :lastname,
                    username = :username,
                    email = :email
                WHERE id = :id
            ");
        } else {
            $this->db
                ->query("UPDATE users
                SET
                    role_id = :role,
                    firstname = :firstname,
                    lastname = :lastname,
                    username = :username,
                    email = :email,
                    password = :password
                WHERE id = :id
            ");

            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        }

        $this->db->bind(':id', $data['user_id']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        return $this->db->execute();
    }

    public function destroy($data)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $data['user_id']);
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
                    users.role_id,
                    users.firstname,
                    users.lastname,
                    users.username,
                    users.email,
                    roles.role as role_title
                FROM users
                LEFT JOIN roles
                ON roles.id = users.role_id
                WHERE users.id = :id
            ");

        $this->db->bind(':id', $id);
        return $this->db->find() ?? false;
    }

    public function getAll()
    {
        $this->db
            ->query("SELECT
                    users.id,
                    users.role_id,
                    users.firstname,
                    users.lastname,
                    users.username,
                    users.email,
                    roles.role as role_title
                FROM users
                LEFT JOIN roles
                ON roles.id = users.role_id
            ");

        return $this->db->findAll() ?? false;
    }
}
