<?php
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-09
 * Time: 15:14
 */

require_once ("config.php");
require_once ("db_access.php");
require_once ("validation.php");


session_start();
if(isset($_SESSION['user'])){
    header('location: list.php');
}
$action = new getFormAction();

//ここでチェックしたいなぁ
$validation = new validationCheck();

//未入力チェック
//if($validation->blankCheck($_POST['username'])){
//    $err['username'] = 'ユーザー名を入力してください。';
//}
//if ($validation->blankCheck($_POST['email'])){
//    $err['email'] = 'メールアドレスを入力してください。';
//}
//if ($validation->blankCheck($_POST['password'])){
//    $err['password'] = 'メールアドレスを入力してください。';
//}
$isErr = false;
$err = [];
foreach ($_POST as $key => $value){
    if($validation->blankCheck($_POST[$key])){
        $err[$key] = "";
        switch ($key)
        {
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



if((isset($_POST['register']))&&($isErr == false)){
    $result = $action->saveDBRegisterData($_POST);
    if($result) {
        $_SESSION['user'] = $_POST['username'];
        echo '<script>
        alert("登録が完了しました。");
//        location.href="list.php";
        </script>';
    } else {
        echo '<script>
        alert("エラーが発生しました。再度入力してください。");
        location.href="register.php";
        </script>';
    }
//    header('location: list.php');
} else {
    require 'v_register.php';
}
