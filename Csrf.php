<?php

class Csrf
{
    //トークン
    private static  $token = null;

    //初期化
    private static function init()
    {
        self::$token = sha1(uniqid());
    }

    //トークンを生成
    public static function get()
    {
        if(is_null(self::$token)) {
            self::init();
        }
        $_SESSION['csrf_token'] = self::$token;
        return self::$token;
    }

    //CSRFチェック
    public static function check()
    {
        //$csrf_tokenにセッション内のトークンを代入
        $csrf_token = $_SESSION['csrf_token'] ?? null;

        $_SESSION['csrf_token'] = null;

        if(filter_input(INPUT_POST, 'csrf_token') !== $csrf_token){
            exit('トークンエラー');
        }
        return true;
    }
}