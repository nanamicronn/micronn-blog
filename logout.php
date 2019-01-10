<?php
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-10
 * Time: 14:23
 */

session_start();
$_SESSION = array();
session_destroy();

require 'login.php';