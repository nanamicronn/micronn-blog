<?php
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-15
 * Time: 14:43
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
    //カテゴリ追加
    case 'add':
        $action->saveDbCategoryData($_POST, $userid);
        header('location: category.php');
        break;

    //削除ボタン
    case 'delete':
        $action->deleteDbCategoryData($_POST);
        header('location: category.php');
        break;

    //編集ボタン
    case 'edit':
        $editcategory = $action->editselectDbCategoryData($_POST);
        $isEdit = true;
        require 'v_category.php';
        break;

    //編集完了ボタン
    case 'editok':
        var_dump($_POST);
        $action->editDbCategoryData($_POST,$userid);
        header('location: category.php');
        break;

    //初回アクセス時、投稿画面表示
    default:
        if(isset($editcategory['name'])==false)
        {
            $editcategory['name'] = "";
            $isEdit = false;
            $categories = $action->getDbCategoryData($userid);
            require 'v_category.php';
        } else {
            echo "ここ";
            require 'v_category.php';
        }
        break;
}
