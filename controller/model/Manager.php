<?php

namespace JeanForteroche\Blog\Model;

class Manager
{
    protected function dbConnect()
    {
        //$db = new \PDO('mysql:host=josephmixt831.mysql.db; dbname=josephmixt831', 'josephmixt831', 'Bijour28469');
        $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root','root');
        return $db;
    }
}
