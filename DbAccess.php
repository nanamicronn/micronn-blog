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
        $smt = $this->pdo->prepare('INSERT INTO posts(title,content,user_id,category_id) VALUES (:title, :content, :user_id, :category_id)');
        $smt->bindParam(':title',$data['title'],PDO::PARAM_STR);
        $smt->bindParam(':content',$data['content'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->bindParam(':category_id',$data['category'],PDO::PARAM_STR);
        $smt->execute();
    }

    function selectDbLisData($userid)
    {
        $smt = $this->pdo->prepare("SELECT posts.id, posts.title, posts.content, posts.time, posts.category_id, categories.name as category_name FROM posts LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.user_id = :user_id ORDER BY posts.id DESC");
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
        $smt = $this->pdo->prepare('UPDATE posts SET title = :title, content = :content, category_id = :category_id WHERE user_id=:userid AND id=:postId');
        $smt->bindParam(':title',$data['title'],PDO::PARAM_STR);
        $smt->bindParam(':content',$data['content'],PDO::PARAM_STR);
        $smt->bindParam(':postId',$data['postId'],PDO::PARAM_STR);
        $smt->bindParam(':userid',$userid,PDO::PARAM_STR);
        $smt->bindParam(':category_id',$data['category'],PDO::PARAM_STR);
        $smt->execute();
    }
    function searchDbListData($data,$userid)
    {
        $searchValue = "%".$data['searchvalue']."%";
        $smt = $this->pdo->prepare("SELECT posts.id, posts.title, posts.content, posts.time, posts.category_id, categories.name as category_name FROM posts LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.user_id = :user_id AND ((posts.title LIKE :searchValue) OR (posts.content LIKE :searchValue))" );
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
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
    function getDbCategoryData($userid)
    {
        $smt = $this->pdo->prepare("SELECT * FROM categories WHERE user_id = :user_id ORDER BY id DESC");
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $categories = $smt->fetchAll();
        return $categories;
    }
    function saveDbCategoryData($data,$userid)
    {
        $smt = $this->pdo->prepare('INSERT INTO categories(name,user_id) VALUES (:name, :user_id)');
        $smt->bindParam(':name',$data['category'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }
    function deleteDbCategoryData($data)
    {
        $smt = $this->pdo->prepare('DELETE FROM categories WHERE id=:categoryId');
        $smt->bindParam(':categoryId',$data['categoryId'],PDO::PARAM_STR);
        $smt->execute();
    }
    function editselectDbCategoryData($data)
    {
        $smt = $this->pdo->prepare("SELECT * FROM categories WHERE id=:categoryId");
        $smt->bindParam(':categoryId',$data['categoryId'],PDO::PARAM_STR);
        $smt->execute();
        $ry = $smt->fetch();
        return $ry;
    }
    function editDbCategoryData($data,$userid)
    {
        $smt = $this->pdo->prepare('UPDATE categories SET name = :name WHERE user_id=:user_id AND id=:categoryId');
        $smt->bindParam(':name',$data['category'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->bindParam(':categoryId',$data['categoryId'],PDO::PARAM_STR);
        $smt->execute();
    }


    function getDbTagData($userid)
    {
        $smt = $this->pdo->prepare("SELECT * FROM tags WHERE user_id = :user_id ORDER BY id DESC");
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $tags = $smt->fetchAll();
        return $tags;
    }
    function saveDbTagData($data,$userid)
    {
        $smt = $this->pdo->prepare('INSERT INTO tags(name,user_id) VALUES (:name, :user_id)');
        $smt->bindParam(':name',$data['tag'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }
    function deleteDbTagData($data)
    {
        $smt = $this->pdo->prepare('DELETE FROM tags WHERE id=:tagId');
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
    }
    function editselectDbTagData($data)
    {
        $smt = $this->pdo->prepare("SELECT * FROM tags WHERE id=:tagId");
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
        $ry = $smt->fetch();
        return $ry;
    }
    function editDbTagData($data,$userid)
    {
        $smt = $this->pdo->prepare('UPDATE tags SET name = :name WHERE user_id=:user_id AND id=:tagId');
        $smt->bindParam(':name',$data['tag'],PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->bindParam(':tagId',$data['tagId'],PDO::PARAM_STR);
        $smt->execute();
    }
    function saveDbPostTagData($postid,$tagid,$userid)
    {
        $smt = $this->pdo->prepare('INSERT INTO post_tag(post_id,tag_id,user_id) VALUES (:post_id, :tag_id, :user_id)');
        $smt->bindParam(':post_id',$postid,PDO::PARAM_STR);
        $smt->bindParam(':tag_id',$tagid,PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }
    function selectDbPostTagData($postid,$userid)
    {
        $smt = $this->pdo->prepare("SELECT post_tag.post_id, post_tag.tag_id, tags.name as tag_name FROM post_tag LEFT JOIN tags ON post_tag.tag_id = tags.id WHERE post_tag.post_id = :post_id AND post_tag.user_id = :user_id ORDER BY tags.id DESC");
        $smt->bindParam(':post_id',$postid,PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
        $posttaglists = $smt->fetchAll();
        return $posttaglists;
    }
    function deleteDbPostTagData($postid,$userid)
    {
        $smt = $this->pdo->prepare('DELETE FROM post_tag WHERE user_id = :user_id AND post_id = :post_id');
        $smt->bindParam(':post_id',$postid,PDO::PARAM_STR);
        $smt->bindParam(':user_id',$userid,PDO::PARAM_STR);
        $smt->execute();
    }
}
