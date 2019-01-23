<?php
ini_set('display_errors', 1);

require_once ('Controller.php');
require_once ('./Entity/PostEntity.php');
require_once ('./Entity/CategoryEntity.php');
require_once ('./Entity/TagEntity.php');
require_once ('./Entity/PostTagEntity.php');

class TagController extends Controller
{
    function index()
    {
        //ユーザーID
        $userid = $_SESSION['userid'];

        $tagEntity = new TagEntity();

        //タグ テーブル取得
        $tags = $tagEntity->get($userid);

        require ('./view/TagView.php');
    }

    function add()
    {
        Csrf::check();

//        //ユーザーID
        $userid = $_SESSION['userid'];

        $tagEntity = new TagEntity();

        //タグ テーブル登録
        $tagEntity->add($_POST, $userid);

        header('location: ../tag');
    }

    function delete()
    {
        Csrf::check();

        $tagEntity = new TagEntity();

        //タグ テーブル削除
        $tagEntity->delete($_POST);

        header('location: ../tag');
    }

    function edit()
    {
        Csrf::check();

        $tagEntity = new TagEntity();

        //編集するタグ テーブルレコード取得
        $edittag = $tagEntity->getedit($_POST);

        require ('./view/TagEditView.php');
    }

    function edited()
    {
        Csrf::check();

        //ユーザーID
        $userid = $_SESSION['userid'];

        $tagEntity = new TagEntity();

        //タグ テーブル更新
        $tagEntity->edit($_POST,$userid);

        header('location: ../tag');
    }
}