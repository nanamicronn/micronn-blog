<?php
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-09
 * Time: 11:25
 */
require_once ("config.php");
require_once ("DbAccess.php");
require_once ("Validation.php");

session_start();
if(isset($_SESSION['user'])){
    header('location: list.php');
}
$action = new DbAccess();
//ここでチェック
$validation = new Validation();

$isErr = false;
$err = [];

if(isset($_POST['login'])) {
//未入力チェック
    foreach ($_POST as $key => $value) {
        if ($validation->isblankCheck($_POST[$key])) {
            $err[$key] = "";
            switch ($key) {
                case 'email':
                    $err[$key] = 'メールアドレスを入力してください。';
                    $isErr = true;
                    break;
                case 'password':
                    $err[$key] = 'パスワードを入力してください。';
                    $isErr = true;
                    break;
                default:
                    break;
            }
        }
    }
    if($isErr != true) {
        if ($action->logincheckDbUsersEmail($_POST) == false) {
            $err['email'] = 'メールアドレスまたはパスワードが一致しません。';
            $err['password'] = 'メールアドレスまたはパスワードが一致しません。';
            $isErr = true;
        }
        $user = $action->logincheckDbUsersEmail($_POST);
//        var_dump($user);
//        echo $_POST['password'];
    }
    if($isErr != true) {
        if (!password_verify($_POST['password'],$user['password'])){
            $err['email'] = 'メールアドレスまたはパスワードが一致しません。';
            $err['password'] = 'メールアドレスまたはパスワードが一致しません。';
            $isErr = true;
        }
    }
}

if(isset($_POST['login']) && $isErr == false) {
    $_SESSION['user'] = $_POST['username'];
    $_SESSION['userid'] = $user['id'];
    header('location: list.php');
}
else {
    require 'v_login.php';
}