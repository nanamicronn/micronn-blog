<?php
ini_set('display_errors', 1);

require_once ('Controller.php');
require_once ('./Entity/PostEntity.php');
require_once ('./Entity/CategoryEntity.php');
require_once ('./Entity/TagEntity.php');
require_once ('./Entity/PostTagEntity.php');

class CategoryController extends Controller
{
    function index()
    {
        //ユーザーID
        $userid = $_SESSION['userid'];

        $categoryEntity = new CategoryEntity();

        //カテゴリ テーブル取得
        $categories = $categoryEntity->get($userid);

        require './view/CategoryView.php';
    }

    function add()
    {
        //ユーザーID
        $userid = $_SESSION['userid'];

        $categoryEntity = new CategoryEntity();

        //カテゴリ テーブル登録
        $categoryEntity->add($_POST, $userid);

        header('location: ../category');
    }

    function delete()
    {
        $categoryEntity = new CategoryEntity();

        //カテゴリ テーブル削除
        $categoryEntity->delete($_POST);

        header('location: ../category');
    }

    function edit()
    {
        $categoryEntity = new CategoryEntity();

        //編集するカテゴリテーブルレコード取得
        $editcategory = $categoryEntity->getedit($_POST);

        require './view/CategoryEditView.php';
    }

    function edited()
    {
        //ユーザーID
        $userid = $_SESSION['userid'];

        $categoryEntity = new CategoryEntity();

        //カテゴリテーブル更新
        $categoryEntity->edit($_POST,$userid);

        header('location: ../category');
    }

}