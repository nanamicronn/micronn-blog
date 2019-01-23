<?php

require_once ('config/DataBase.php');

class PostTagEntity extends Entity
{
    function add(int $postid,int $tagid,int $userid) :void
    {
        $smt = $this->pdo->prepare('INSERT INTO post_tag(post_id,tag_id,user_id) VALUES (:post_id, :tag_id, :user_id)');
        $smt->bindParam(':post_id',$postid,PDO::PARAM_STR);
        $smt->bindParam(':tag_id',$tagid,PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }

    function get(int $postid,int $userid) :array
    {
        $smt = $this->pdo->prepare("SELECT post_tag.post_id, post_tag.tag_id, tags.name as tag_name FROM post_tag LEFT JOIN tags ON post_tag.tag_id = tags.id WHERE post_tag.post_id = :post_id AND post_tag.user_id = :user_id ORDER BY tags.id DESC");
        $smt->bindParam(':post_id',$postid,PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $posttaglists = $smt->fetchAll();
        return $posttaglists;
    }

    function delete(int $postid,int $userid) :void
    {
        $smt = $this->pdo->prepare('DELETE FROM post_tag WHERE user_id = :user_id AND post_id = :post_id');
        $smt->bindParam(':post_id',$postid,PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }

}