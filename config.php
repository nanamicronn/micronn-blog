<?php
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-07
 * Time: 16:33
 */

define('DATABASE_NAME','blog');
define('DATABASE_USER','root');
define('DATABASE_PASSWORD','root');
define('DATABASE_HOST','localhost');

define('PDO_DSN','mysql:dbname=' . DATABASE_NAME .';host=' . DATABASE_HOST . '; charset=utf8');