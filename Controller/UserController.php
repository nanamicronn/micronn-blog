<?php
//ini_set('display_errors', 1);

require_once ('Controller.php');
require_once ('./Csrf.php');
require_once ('./Entity/UserEntity.php');
require_once ('./Validation.php');

class UserController
{
    public function login()
    {
        if(isset($_SESSION['userid'])){
            Csrf::check();
            header('location: ./list');
        }
        $userEntity = new UserEntity();
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
                $user = $userEntity->logincheck($_POST);
                if (empty($user)) {
                    $err['email'] = 'メールアドレスまたはパスワードが一致しません。';
                    $err['password'] = 'メールアドレスまたはパスワードが一致しません。';
                    $isErr = true;
                }
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
            Csrf::check();
            $_SESSION['userid'] = $user['id'];
            header('location: ./list');
        }
        else {
            Csrf::check();
            require './view/LoginView.php';
        }

    }
    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('location: ./login');
//        echo "ログアウトしました。";
    }

    public function register()
    {
        if(isset($_SESSION['userid'])){
            Csrf::check();
            header('location: ./list');
        }
        $userEntity = new UserEntity();
        $validation = new Validation();

        $isErr = false;
        $err = [];

        if(isset($_POST['register'])) {
            //未入力チェック
            foreach ($_POST as $key => $value) {
                if ($validation->isblankCheck($_POST[$key])) {
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
                if ($userEntity->countname($_POST) > 0) {
                    $err['username'] = 'そのユーザー名は既に使用されています。';
                    $isErr = true;
                }
                if ($userEntity->countemail($_POST) > 0) {
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
            Csrf::check();
            $result = $userEntity->add($_POST);
            if($result) {
                $user = $userEntity->get($_POST);
                $_SESSION['userid'] = $user['id'];
                echo '<script>
                alert("登録が完了しました。");
                location.href="./list";
                </script>';
            } else {
                echo '<script>
                alert("エラーが発生しました。再度入力してください。");
                location.href="./register";
                </script>';
            }
        } else {
        require './view/RegisterView.php';
        }

    }
    public function other()
    {
        header('location: ./login');
        exit;
    }
}