<?php


class DB
{
    private static $pdo = null;

    public static function get()
    {
        $host = 'localhost';
        $dbname = 'sevalo';
        $user = 'postgres';
        $password = 'admin';

        
        $dbconn = pg_pconnect("host={$host} port=5432 dbname={$dbname} user={$user} password={$password}");

        return $dbconn;
    }
}