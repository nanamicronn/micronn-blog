<?php

require_once ('config/DataBase.php');

/*
 * Class Entity
 */
abstract class Entity
{
    public $pdo;

    /**
     *  PDO
     */
    function  __construct()
    {
        try {
            $this->pdo = new PDO(DataBase::PDO_DSN, DataBase::DATABASE_USER, DataBase::DATABASE_PASSWORD);
        } catch (PDOException $e) {
            echo 'error'.$e->getMessage();
            die();
        }
    }
}