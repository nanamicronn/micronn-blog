<?php

require_once ('Entity.php');

class TagEntity extends Entity
{
    function add(array $data,int $userid) //saveDbTagData
    {
        $smt = $this->pdo->prepare('INSERT INTO tags(name,user_id) VALUES (:name, :user_id)');
        $smt->bindParam(':name',$data['tag'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }

    function get(int $userid) //getDbTagData
    {
        $smt = $this->pdo->prepare("SELECT * FROM tags WHERE user_id = :user_id ORDER BY id DESC");
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $tags = $smt->fetchAll();
        return $tags;
    }

    function delete(array $data) //deleteDbTagData
    {
        $smt = $this->pdo->prepare('DELETE FROM tags WHERE id=:tagId');
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
    }

    function getedit(array $data) //editselectDbTagData
    {
        $smt = $this->pdo->prepare("SELECT * FROM tags WHERE id=:tagId");
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
        $result = $smt->fetch();
        return $result;
    }

    function edit(array $data,int $userid) //editDbTagData
    {
        $smt = $this->pdo->prepare('UPDATE tags SET name = :name WHERE user_id=:user_id AND id=:tagId');
        $smt->bindParam(':name',$data['tag'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
    }
}