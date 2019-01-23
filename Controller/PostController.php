<?php
ini_set('display_errors', 1);

require_once ('Controller.php');
require_once ('./Csrf.php');
require_once ('./Entity/PostEntity.php');
require_once ('./Entity/CategoryEntity.php');
require_once ('./Entity/TagEntity.php');
require_once ('./Entity/PostTagEntity.php');

class PostController extends Controller
{
    public function index()
    {
        //ユーザーID
        $userid = $_SESSION['userid'];

        $categoryEntity = new CategoryEntity();
        $tagEntity = new TagEntity();

        //カテゴリ テーブル取得
        $categories = $categoryEntity->get($userid);

        //タグ テーブル取得
        $tags = $tagEntity->get($userid);

        require ('./view/PostView.php');
    }
    public  function add()
    {
        Csrf::check();

        //ユーザーID
        $userid = $_SESSION['userid'];

        $postEntity = new PostEntity();
        $tagEntity = new TagEntity();
        $posttagEntity = new PostTagEntity();

        //記事 テーブル登録
        $postEntity->add($_POST, $userid);

        //記事 テーブル取得（記事一覧）←postid取得の為
        $lists = $postEntity->get($userid);
        $postid = $lists[0][0];

        //タグ テーブル取得
        $tags = $tagEntity->get($userid);

        //チェックインされたタグチェックボックスを選別
        foreach ($_POST as $key => $post) {
            foreach ($tags as $tag) {
                if ($key == $tag['id']) {
                    $posttagEntity->add($postid, $key, $userid);
                }
            }
        }
        header('Location: ../list');
    }

    public function list()
    {
        //ユーザーID
        $userid = $_SESSION['userid'];

        $postEntity = new PostEntity();
        $posttagEntity = new PostTagEntity();

        //記事 テーブル取得（記事一覧）
        $lists = $postEntity->get($userid);

        //チェックインされたタグチェックボックスを選別
        foreach ($lists as $list) {
            $postid = $list['id'];
            $posttaglists = $posttagEntity->get($postid,$userid);
            foreach ($posttaglists as $posttag){
                if($posttag['post_id'] == $list['id']){
                    $taglists[$postid][]=$posttag['tag_name'];
                }
            }
        }
        require './view/ListView.php';
    }

    public function delete()
    {
        Csrf::check();

        $postEntity = new PostEntity();

        //記事削除
        $postEntity->delete($_POST);

        header('Location: ../list');
    }

    public function edit()
    {
        Csrf::check();

        //ユーザーID
        $userid = $_SESSION['userid'];

        $postEntity = new PostEntity();
        $categoryEntity = new CategoryEntity();
        $tagEntity = new TagEntity();
        $posttagEntity = new PostTagEntity();

        //編集する記事テーブルレコード取得
        $posts = $postEntity->getedit($_POST); //potsのでーた　category_id

        //カテゴリ テーブル取得
        $categories = $categoryEntity->get($userid);

        //タグ テーブル取得
        $tags = $tagEntity->get($userid);

        //ポストID
        $postid = $posts['id'];

        //ポストタグ テーブル取得
        $posttaglists = $posttagEntity->get($postid, $userid);

        require './view/PostEditView.php';
    }

    public function edited()
    {
        Csrf::check();

        //ユーザーID
        $userid = $_SESSION['userid'];

        var_dump($_POST);
        $postEntity = new PostEntity();
        $tagEntity = new TagEntity();
        $posttagEntity = new PostTagEntity();

        $postEntity->edit($_POST, $userid);
        $postid = $_POST['postId'];
        $posttagEntity->delete($postid, $userid);
        $tags = $tagEntity->get($userid);
        foreach ($_POST as $key => $post) {
            foreach ($tags as $tag) {
                if ($key == $tag['id']) {
                    $posttagEntity->add($postid, $key, $userid);
                }
            }
        }
        header('Location: ../list');
    }
    public function search()
    {
        Csrf::check();

        //ユーザーID
        $userid = $_SESSION['userid'];

        $searchword = $_GET['searchvalue'];

        $postEntity = new PostEntity();
        $posttagEntity = new PostTagEntity();

        $lists = $postEntity->search($_GET,$userid);
        foreach ($lists as $list) {
            $postid = $list['id'];
            $posttaglists = $posttagEntity->get($postid,$userid);
            foreach ($posttaglists as $posttag){
                if($posttag['post_id'] == $list['id']){
                    $taglists[$postid][]=$posttag['tag_name'];
                }

            }
        }
        require './view/ListView.php';
    }

}