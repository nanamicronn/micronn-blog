<?php

require_once ('Entity.php');

class CategoryEntity extends Entity
{
    function add(array $data, int $userid) //saveDbCategoryData
    {
        $smt = $this->pdo->prepare('INSERT INTO categories(name,user_id) VALUES (:name, :user_id)');
        $smt->bindParam(':name',$data['category'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }

    function get($userid) //getDbCategoryData
    {
        $smt = $this->pdo->prepare("SELECT * FROM categories WHERE user_id = :user_id ORDER BY id DESC");
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $categories = $smt->fetchAll();
        return $categories;
    }

    function delete($data) //deleteDbCategoryData
    {
        $smt = $this->pdo->prepare('DELETE FROM categories WHERE id=:categoryId');
        $smt->bindParam(':categoryId',$data['categoryId'],PDO::PARAM_STR);
        $smt->execute();
    }

    function edit($data,$userid) //editDbCategoryData
    {
        $smt = $this->pdo->prepare('UPDATE categories SET name = :name WHERE user_id=:user_id AND id=:categoryId');
        $smt->bindParam(':name',$data['category'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->bindParam(':categoryId',$data['categoryId'],PDO::PARAM_STR);
        $smt->execute();
    }


    function getedit($data) //editselectDbCategoryData
    {
        $smt = $this->pdo->prepare("SELECT * FROM categories WHERE id=:categoryId");
        $smt->bindParam(':categoryId',$data['categoryId'],PDO::PARAM_STR);
        $smt->execute();
        $result = $smt->fetch();
        return $result;
    }
}