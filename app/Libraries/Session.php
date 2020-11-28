<?php

namespace Covid\App\Libraries;

use Covid\App\Models\User;

class Session
{
    public static function get($key = null)
    {
        if ($_SESSION[$key]) {
            return $_SESSION[$key];
        }

        return $key;
    }

    /**
     * Put a session
     *
     * @param array $session
     */
    public static function put($sessions)
    {
        foreach ($sessions as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public static function destroy()
    {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
    }

    public static function exists($key = 'user-id')
    {
        return isset($_SESSION[$key]);
    }

    public static function getData(User $user)
    {
        if (Session::exists()) {
            $user = $user->getById(Session::get('user-id'));

            if ($user) {
                $roleTitle = $user->role ? 'Administrator' : 'Regular User';

                return [
                    'id' => Session::get('user-id'),
                    'role' => $user->role,
                    'role_title' => $roleTitle,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'username' => $user->username,
                    'email' => $user->email,
                ];
            } else {
                return header('Location: ' . config('app.url')  . '/logout');
            }
        }

        return null;
    }
}
