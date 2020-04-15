<?php


class db
{
    public static function getConnection(){
        $paramsPath =ROOT.'/config/db_params.php';
        $params = include($paramsPath);

        // $db = new mysqli("localhost","root","","mvc_site");
        $dsn = "{$params['host']}";
        $db = new mysqli($dsn,$params['user'],$params['password'],$params['dbname']);
        $db ->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
        return $db;
    }
}