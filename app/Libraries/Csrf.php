<?php

namespace Covid\App\Libraries;

class Csrf
{
    public static function make()
    {
        Session::put([
            'csrf-token' => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32),
            'csrf-token-expiry' => time() + 900,
        ]);
    }
}
