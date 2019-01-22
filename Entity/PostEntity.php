<?php

require_once ('Entity.php');

class PostEntity extends Entity
{

    function add($data,$userid) //saveDbPostData
    {
        $smt = $this->pdo->prepare('INSERT INTO posts(title,content,user_id,category_id) VALUES (:title, :content, :user_id, :category_id)');
        $smt->bindParam(':title',$data['title'],PDO::PARAM_STR);
        $smt->bindParam(':content',$data['content'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->bindParam(':category_id',$data['category'],PDO::PARAM_STR);
        $smt->execute();
    }

    function get($userid) //selectDbLisData
    {
        $smt = $this->pdo->prepare("SELECT posts.id, posts.title, posts.content, posts.time, posts.category_id, categories.name as category_name FROM posts LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.user_id = :user_id ORDER BY posts.id DESC");
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $lists = $smt->fetchAll();
        return $lists;
    }

    function delete($data) //deleteDbListData
    {
        $smt = $this->pdo->prepare('DELETE FROM posts WHERE id=:postId');
        $smt->bindParam(':postId',$data['postId'],PDO::PARAM_STR);
        $smt->execute();
    }

    function edit($data,$userid) //editDbListData
    {
        $smt = $this->pdo->prepare('UPDATE posts SET title = :title, content = :content, category_id = :category_id WHERE user_id=:userid AND id=:postId');
        $smt->bindParam(':title',$data['title'],PDO::PARAM_STR);
        $smt->bindParam(':content',$data['content'],PDO::PARAM_STR);
        $smt->bindParam(':postId',$data['postId'],PDO::PARAM_STR);
        $smt->bindParam(':userid',$userid,PDO::PARAM_STR);
        $smt->bindParam(':category_id',$data['category'],PDO::PARAM_STR);
        $smt->execute();
    }

    function getedit($data) //editselectDbListData
    {
        $smt = $this->pdo->prepare("SELECT * FROM posts WHERE id=:postId");
        $smt->bindParam(':postId',$data['postId'],PDO::PARAM_STR);
        $smt->execute();
        $posts = $smt->fetch();
        return $posts;
    }

    function search($data,$userid) //searchDbListData
    {
        $searchValue = "%".$data['searchvalue']."%";
        $smt = $this->pdo->prepare("SELECT posts.id, posts.title, posts.content, posts.time, posts.category_id, categories.name as category_name FROM posts LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.user_id = :user_id AND ((posts.title LIKE :searchValue) OR (posts.content LIKE :searchValue))" );
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->bindParam(':searchValue',$searchValue,PDO::PARAM_STR);
        $smt->execute();
        $lists = $smt->fetchAll();
        return $lists;
    }

}