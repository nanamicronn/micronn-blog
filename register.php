<?php
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-09
 * Time: 15:14
 */

require_once ("config.php");
require_once("DbAccess.php");
require_once("Validation.php");


session_start();
if(isset($_SESSION['user'])){
    header('location: list.php');
}
$action = new DbAccess();

//ここでチェック
$validation = new Validation();

$isErr = false;
$err = [];

if(isset($_POST['register'])) {
//未入力チェック
    foreach ($_POST as $key => $value) {
        if ($validation->blankCheck($_POST[$key])) {
            $err[$key] = "";
            switch ($key) {
                case 'username':
                    $err[$key] = 'ユーザー名を入力してください。';
                    $isErr = true;
                    break;
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

//存在チェック
    if ($isErr != true) {
        if ($action->countDbUsersName($_POST) > 0) {
            $err['username'] = 'そのユーザー名は既に使用されています。';
            $isErr = true;
        }
        if ($action->countDbUsersEmail($_POST) > 0) {
            $err['email'] = 'そのメールアドレスは既に使用されています。';
            $isErr = true;
        }
    }

//メール形式チェック
    if ($isErr != true) {
        if ($validation->emailCheck($_POST['email'])) {
            $err['email'] = 'メール形式が正しくありません。';
            $isErr = true;
        }
    }

//文字数制限
    if($isErr != true){
        if($validation->length2_8Check(strlen($_POST['username']))){
            $err['username'] = 'そのユーザー名は2〜8文字で入力してください。';
            $isErr = true;
        }
        if($validation->length_50Check(strlen($_POST['email']))){
            $err['email'] = 'そのメールアドレスは50文字以内で入力してください。';
            $isErr = true;
        }
        if($validation->length2_8Check(strlen($_POST['password']))){
            $err['password'] = 'そのパスワードは2〜8文字で入力してください。';
            $isErr = true;
        }
    }
//使用不可文字チェック
    if($isErr != true){
        if($validation->typeCheck($_POST['username'])){
            $err['username'] = '使用可能：半角英数';
            $isErr = true;
        }
        if($validation->typeCheck($_POST['password'])){
            $err['password'] = '使用可能：半角英数';
            $isErr = true;
        }
    }
}

if(isset($_POST['register']) && $isErr == false){
    $result = $action->saveDbRegisterData($_POST);
    if($result) {
        $user = $action->getDbUsersData($_POST);
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['userid'] = $user['id'];
        echo '<script>
        alert("登録が完了しました。");
        location.href="list.php";
        </script>';
    } else {
        echo '<script>
        alert("エラーが発生しました。再度入力してください。");
        location.href="register.php";
        </script>';
    }
}
else {
    require 'v_register.php';
}
