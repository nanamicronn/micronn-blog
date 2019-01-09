<?php
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-07
 * Time: 17:00
 */

require_once ("config.php");
require_once ("db_access.php");
require_once ("header.php");

$isEdit = false;
//イベントID???
if(isset($_POST['save'])){
    $eventId = 'save';
}
if(isset($_POST['editok'])){
    $eventId = 'editok';
}
switch ($eventId)
{
    //DBsave
    case 'save':
        $action->saveDbPostData($_POST);
        require ("list.php");
        break;

    //検索ボタン
    case 'search':
        $lists = $action->searchDbListData($_GET);
        var_dump($lists);
        require 'v_list.php';
        break;

    //編集完了ボタン
    case 'editok':
        $action->editDbListData($_POST);
        require ("list.php");
        break;

    //初回アクセス時、投稿画面表示
    default:
        if((isset($posts['title'])==false)&&(isset($posts['content'])==false))
        {
            $posts['title'] = "";
            $posts['content'] = "";
            $isEdit = false;
        } else {
            $isEdit = true;
        }
        require ("v_post.php");
        break;
}
