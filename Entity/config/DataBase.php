<?php

//define('DATABASE_NAME','blog');
//define('DATABASE_USER','root');
//define('DATABASE_PASSWORD','root');
//define('DATABASE_HOST','localhost');
//define('PDO_DSN','mysql:dbname=' . DATABASE_NAME .';host=' . DATABASE_HOST . '; charset=utf8');

class DataBase{
const DATABASE_NAME = 'blog';
const DATABASE_USER = 'root';
const DATABASE_PASSWORD = 'root';
const DATABASE_HOST = 'localhost';
const PDO_DSN = 'mysql:dbname=' . self::DATABASE_NAME .';host=' . self::DATABASE_HOST . '; charset=utf8';
}