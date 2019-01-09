<?php
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-07
 * Time: 17:00
 */

class getFormAction
{
    public $pdo;

    /**
     *  コネクション確立
     */
    function  __construct()
    {
        $this->pdo = new PDO( PDO_DSN, DATABASE_USER, DATABASE_PASSWORD);
    }

    /**
     *   記事データをDBに保存
     */
    function saveDbPostData($data)
    {
        $kari = 222;
        $smt = $this->pdo->prepare('INSERT INTO posts(title,content,user_id) VALUES (:title, :content, :user_id)');
        $smt->bindParam(':title',$data['title'],PDO::PARAM_STR);
        $smt->bindParam(':content',$data['content'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$kari,PDO::PARAM_STR);
        $smt->execute();
    }

    function selectDbLisData()
    {
        $st = $this->pdo->query("SELECT * FROM posts ORDER BY id DESC");
        $lists = $st->fetchAll();
        return $lists;
    }

    function deleteDbListData($data)
    {
        $smt = $this->pdo->prepare('DELETE FROM posts WHERE id=:postId');
        $smt->bindParam(':postId',$data['postId'],PDO::PARAM_STR);
        $smt->execute();
    }
    function editselectDbListData($data)
    {
        $smt = $this->pdo->prepare("SELECT * FROM posts WHERE id=:postId");
        $smt->bindParam(':postId',$data['postId'],PDO::PARAM_STR);
        $smt->execute();
        $posts = $smt->fetch();
        return $posts;
    }
    function editDbListData($data)
    {
        $smt = $this->pdo->prepare('UPDATE posts SET title = :title, content = :content WHERE id=:postId');
        $smt->bindParam(':title',$data['title'],PDO::PARAM_STR);
        $smt->bindParam(':content',$data['content'],PDO::PARAM_STR);
        $smt->bindParam(':postId',$data['postId'],PDO::PARAM_STR);
        $smt->execute();
    }
    function searchDbListData($data)
    {
        $searchValue = "%".$data['search']."%";
        $smt = $this->pdo->prepare("SELECT * FROM posts WHERE (title LIKE :searchValue) OR content LIKE :searchValue" );
        $smt->bindParam(':searchValue',$searchValue,PDO::PARAM_STR);
        $smt->execute();
        $lists = $smt->fetchAll();
        return $lists;
    }
}
