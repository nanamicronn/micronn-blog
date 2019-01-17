<?php
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-16
 * Time: 11:35
 */
require_once("config.php");
require_once("DbAccess.php");
require_once ("header.php");

if(!isset($_SESSION['userid'])){
    session_start();
    $userid = $_SESSION['userid'];
}

$isEdit = false;

//var_dump($_POST);

if(isset($_POST['add'])) {
    $eventId = "add";
}
if(isset($_POST['delete'])) {
    $eventId = "delete";
}
if(isset($_POST['edit'])){
    $eventId = 'edit';
}
if(isset($_POST['editok'])){
    $eventId = 'editok';
}

switch ($eventId)
{
    //タグ追加
    case 'add':
        $action->saveDbTagData($_POST, $userid);
        header('location: tag.php');
        break;

    //削除ボタン
    case 'delete':
        $action->deleteDbTagData($_POST);
        header('location: tag.php');
        break;

    //編集ボタン
    case 'edit':
        var_dump($_POST);
        $edittag = $action->editselectDbTagData($_POST);
        $isEdit = true;
        require 'v_tag.php';
        break;

    //編集完了ボタン
    case 'editok':
//        var_dump($_POST);
        $action->editDbTagData($_POST,$userid);
        header('location: tag.php');
        break;

    //初回アクセス時、投稿画面表示
    default:
        if(isset($edittag['name'])==false)
        {
            $edittag['name'] = "";
            $isEdit = false;
            $tags = $action->getDbTagData($userid);
            require 'v_tag.php';
        } else {
            echo "ここ";
            require 'v_tag.php';
        }
        break;
}