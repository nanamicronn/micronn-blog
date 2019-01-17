<?php
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-07
 * Time: 15:05
 */
require_once("config.php");
require_once("DbAccess.php");
require_once ("header.php");

if(!isset($_SESSION['userid'])){
    session_start();
    $userid = $_SESSION['userid'];
}

if(isset($_POST['delete'])) {
    $eventId = "delete";
}
if(isset($_POST['edit'])){
    $eventId = "edit";
}
if(isset($_GET['search'])){
    $eventId = "search";
}


switch ($eventId)
{
    //削除ボタン
    case 'delete':
        $action->deleteDbListData($_POST);
        $lists = $action->selectDbLisData($userid);
        foreach ($lists as $list) {
            $postid = $list['id'];
            $posttaglists = $action->selectDbPostTagData($postid,$userid);
            foreach ($posttaglists as $posttag){
                if($posttag['post_id'] == $list['id']){
                    $taglists[$postid][]=$posttag['tag_name'];
                }

            }
        }
        require 'v_list.php';
        break;

    //編集ボタン
    case 'edit':
        $posts = $action->editselectDbListData($_POST); //potsのでーた　category_id
        $categories = $action->getDbCategoryData($userid);
        $tags = $action->getDbTagData($userid);
        require 'post.php';
        break;

    //検索ボタン
    case 'search':
        $lists = $action->searchDbListData($_GET,$userid);
        foreach ($lists as $list) {
            $postid = $list['id'];
            $posttaglists = $action->selectDbPostTagData($postid,$userid);
            foreach ($posttaglists as $posttag){
                if($posttag['post_id'] == $list['id']){
                    $taglists[$postid][]=$posttag['tag_name'];
                }

            }
        }
        require 'v_list.php';
    break;

    //初回アクセス時、投稿画面表示
    default:
        $lists = $action->selectDbLisData($userid);
        foreach ($lists as $list) {
            $postid = $list['id'];
            $posttaglists = $action->selectDbPostTagData($postid,$userid);
            foreach ($posttaglists as $posttag){
                if($posttag['post_id'] == $list['id']){
                    $taglists[$postid][]=$posttag['tag_name'];
                }

            }
        }
        require 'v_list.php';
        break;
}