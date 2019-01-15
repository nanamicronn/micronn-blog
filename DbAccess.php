<?php
/**
 * Created by PhpStorm.
 * User: nanami
 * Date: 2019-01-07
 * Time: 17:00
 */

class DbAccess
{
    public $pdo;

    /**
     *  コネクション確立
     */
    function  __construct()
    {
        try {
            $this->pdo = new PDO(PDO_DSN, DATABASE_USER, DATABASE_PASSWORD);
        } catch (PDOException $e) {
            echo 'error'.$e->getMessage();
            die();
        }
    }

    /**
     *   記事データをDBに保存
     */
    function saveDbPostData($data,$userid)
    {
//        $kari = 222;
        $smt = $this->pdo->prepare('INSERT INTO posts(title,content,user_id) VALUES (:title, :content, :user_id)');
        $smt->bindParam(':title',$data['title'],PDO::PARAM_STR);
        $smt->bindParam(':content',$data['content'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }

    function selectDbLisData($userid)
    {
        $smt = $this->pdo->prepare("SELECT * FROM posts WHERE user_id = :user_id ORDER BY id DESC");
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $lists = $smt->fetchAll();
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
    function editDbListData($data,$userid)
    {
        $smt = $this->pdo->prepare('UPDATE posts SET title = :title, content = :content WHERE user_id=:userid AND id=:postId');
        $smt->bindParam(':title',$data['title'],PDO::PARAM_STR);
        $smt->bindParam(':content',$data['content'],PDO::PARAM_STR);
        $smt->bindParam(':postId',$data['postId'],PDO::PARAM_STR);
        $smt->bindParam(':userid',$userid,PDO::PARAM_STR);
        $smt->execute();
    }
    function searchDbListData($data,$userid)
    {
        $searchValue = "%".$data['search']."%";
        $smt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :userid AND ((title LIKE :searchValue) OR (content LIKE :searchValue))" );
        $smt->bindParam(':userid',$userid,PDO::PARAM_STR);
        $smt->bindParam(':searchValue',$searchValue,PDO::PARAM_STR);
        $smt->execute();
        $lists = $smt->fetchAll();
        return $lists;
    }
    function saveDbRegisterData($data)
    {
        $smt = $this->pdo->prepare('INSERT INTO users(name,email,password) VALUES (:name, :email, :password)');
        $pass = password_hash($data['password'], PASSWORD_DEFAULT);
        $smt->bindParam(':name',$data['username'],PDO::PARAM_STR);
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->bindParam(':password',$pass,PDO::PARAM_STR);
        $result = $smt->execute();
        return $result;
    }
    function countDbUsersName($data)
    {
        $smt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE name=:name');
        $smt->bindParam(':name',$data['username'],PDO::PARAM_STR);
        $smt->execute();
        $count = $smt->fetchColumn();
        return $count;
    }
    function countDbUsersEmail($data)
    {
        $smt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE email=:email');
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->execute();
        $count = $smt->fetchColumn();
        return $count;
    }
    function getDbUsersData($data)
    {
        $smt = $this->pdo->prepare("SELECT * FROM users WHERE name=:name AND email=:email" );
        $smt->bindParam(':name',$data['username'],PDO::PARAM_STR);
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->execute();
        $user = $smt->fetch();
        return $user;
    }
    function logincheckDbUsersEmail($data)
    {
        $smt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email" );
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->execute();
        $result = $smt->fetch();
        return $result;
    }
    function logincheckDbUsersPassword($data)
    {
        $smt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email AND password=:password" );
        $pass = password_hash($data['password'], PASSWORD_DEFAULT);
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->bindParam(':password',$pass,PDO::PARAM_STR);
        $smt->execute();
        $result = $smt->fetch();
        return $result;
    }
}
