<?php
ini_set('display_errors', 1);


require_once ('Controller.php');
require_once ('./Entity/PostEntity.php');
require_once ('./Entity/CategoryEntity.php');
require_once ('./Entity/TagEntity.php');
require_once ('./Entity/PostTagEntity.php');

class PostController extends Controller
{
    public function index()
    {
        //ユーザーID（仮）
        $userid = 64;

        $categorEntity = new CategoryEntity();
        $tagEntity = new TagEntity();

        //カテゴリテーブル取得
        $categories = $categorEntity->get($userid);

        //タグテーブル取得
        $tags = $tagEntity->get($userid);

        require ('./view/PostView.php');
    }
    public  function add()
    {
        //ユーザーID（仮）
        $userid = 64;

        $postEntity = new PostEntity();
        $tagEntity = new TagEntity();
        $posttagEntity = new PostTagEntity();

        //記事テーブル登録
        $postEntity->add($_POST, $userid);

        //記事テーブル取得（記事一覧）←postid取得の為
        $lists = $postEntity->get($userid);
        $postid = $lists[0][0];

        //タグテーブル取得
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
        //ユーザーID（仮）
        $userid = 64;

        $postEntity = new PostEntity();
        $posttagEntity = new PostTagEntity();

        //記事テーブル取得（記事一覧）
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
        //ユーザーID（仮）
        $userid = 64;

        $postEntity = new PostEntity();

        //記事削除
        $postEntity->delete($_POST);

        header('Location: ./list');
    }
}