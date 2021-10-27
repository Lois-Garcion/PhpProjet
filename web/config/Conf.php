<?php


class Conf
{

    static private $databases = array(
        'hostname' => 'webinfo',
        'database' => 'garcionl',
        'login' => 'garcionl',
        'password' => '061094714FH'
    );

    static public function getHostname()
    {
        return self::$databases['hostname'];
    }

    static public function getDatabase()
    {
        return self::$databases['database'];
    }

    static public function getLogin()
    {
        return self::$databases['login'];
    }

    static public function getPassword()
    {
        return self::$databases['password'];
    }

}



