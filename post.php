<?php
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-07
 * Time: 17:00
 */

require_once ("config.php");
require_once("DbAccess.php");
require_once ("header.php");

if(!isset($_SESSION['userid'])){
    session_start();
    $userid = $_SESSION['userid'];
}

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
    //投稿ボタン（save）
    case 'save':
        $action->saveDbPostData($_POST, $userid);
        $lists = $action->selectDbLisData($userid);
        $postid = $lists[0][0];
        $tags = $action->getDbTagData($userid);
        foreach ($_POST as $key=>$post){
            foreach ($tags as $tag){
                if($key == $tag['id']){
                    $action->saveDbPostTagData($postid,$key,$userid);
                }
            }
    }

//        require ("list.php");
        header('location: list.php');
        break;

    //検索ボタン
    case 'search':
        $lists = $action->searchDbListData($_GET,$userid);
        require 'v_list.php';
        break;

    //編集完了ボタン
    case 'editok':
        var_dump($_POST);
        $action->editDbListData($_POST,$userid);
        $postid = $_POST['postId'];
        $action->deleteDbPostTagData($postid,$userid);
        $tags = $action->getDbTagData($userid);
        foreach ($_POST as $key=>$post){
            foreach ($tags as $tag){
                if($key == $tag['id']){
                    $action->saveDbPostTagData($postid,$key,$userid);
                }
            }
        }
//        require ("list.php");
        header('location: list.php');
        break;

    //初回アクセス時、投稿画面表示
    default:
        if((isset($posts['title'])==false)&&(isset($posts['content'])==false))
        {
            $categories = $action->getDbCategoryData($userid);
            $tags = $action->getDbTagData($userid);
            $posts['title'] = "";
            $posts['content'] = "";
            $posts['id'] = "";
            $isEdit = false;
        } else {
            $postid = $posts['id'];
            $posttaglists = $action->selectDbPostTagData($postid,$userid);
//            var_dump($tags);
            $isEdit = true;
        }
        require ("v_post.php");
        break;
}
