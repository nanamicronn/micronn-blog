<?php
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-09
 * Time: 10:08
 */

require_once("config.php");
require_once("DbAccess.php");

$action = new DbAccess();
$eventId = null;

if(isset($_GET['search'])){
    $search = htmlspecialchars($_GET['search']);
    $searchValue = $search;
    $eventId = 'search';
} else {
    $search = '';
    $searchValue = '';
}
require 'v_header.php';



//$eventId = null;
//
//if(isset($_POST['delete'])) {
//    $eventId = "delete";
//}
//if(isset($_POST['edit'])){
//    $eventId = "edit";
//}
//
//switch ($eventId)
//{
//    //削除ボタン
//    case 'delete':
//        $action->deleteDbListData($_POST);
//        $lists = $action->selectDbLisData();
//        require 'v_list.php';
//        break;
//
//    //編集ボタン
//    case 'edit':
//        $posts = $action->editselectDbListData($_POST);
//        require 'post.php';
//        break;
//
//    //初回アクセス時、投稿画面表示
//    default:
//        $lists = $action->selectDbLisData();
//        require 'v_list.php';
//        break;
//}