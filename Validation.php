<?php

//バリデーションクラス　基本true返すときにエラーメッセージ
class Validation
{
    //未入力チェック
    function isblankCheck($value)
    {
        return empty($value);
    }
    //メール形式チェック
    function emailCheck($value)
    {
        if(filter_var($value, FILTER_VALIDATE_EMAIL)){
            return false;
        } else {
            return true;
        }
    }
    //文字数制限（2〜8文字）
    function length2_8Check($value)
    {
        //半角2文字以上8文字以下
        if(($value < 2) or ($value > 8)){
            return true;
        } else {
            return false;
        }

    }
    //文字数制限（〜50文字）
    function length_50Check($value)
    {
        //50文字以上
        if($value > 50){
            return true;
        } else {
            return false;
        }
    }
    //使用不可文字チェック（）
    function typeCheck($value)
    {
        if(preg_match("/^[A-Za-z0-9_]+$/",$value)){
            return false;
        } else {
            return true;
        }
    }


}