<?php

require_once ('Entity.php');

class TagEntity extends Entity
{
    function add($data,$userid) //saveDbTagData
    {
        $smt = $this->pdo->prepare('INSERT INTO tags(name,user_id) VALUES (:name, :user_id)');
        $smt->bindParam(':name',$data['tag'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }

    function get($userid) //getDbTagData
    {
        $smt = $this->pdo->prepare("SELECT * FROM tags WHERE user_id = :user_id ORDER BY id DESC");
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $tags = $smt->fetchAll();
        return $tags;
    }

    function delete($data) //deleteDbTagData
    {
        $smt = $this->pdo->prepare('DELETE FROM tags WHERE id=:tagId');
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
    }

    function getedit($data) //editselectDbTagData
    {
        $smt = $this->pdo->prepare("SELECT * FROM tags WHERE id=:tagId");
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
        $ry = $smt->fetch();
        return $ry;
    }

    function edit($data,$userid) //editDbTagData
    {
        $smt = $this->pdo->prepare('UPDATE tags SET name = :name WHERE user_id=:user_id AND id=:tagId');
        $smt->bindParam(':name',$data['tag'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
    }
}