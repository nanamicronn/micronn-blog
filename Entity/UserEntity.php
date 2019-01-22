<?php

require_once ('Entity.php');

class UserEntity extends Entity
{
    function add(array $data) //saveDbRegisterData
    {
        $smt = $this->pdo->prepare('INSERT INTO users(name,email,password) VALUES (:name, :email, :password)');
        $pass = password_hash($data['password'], PASSWORD_DEFAULT);
        $smt->bindParam(':name',$data['username'],PDO::PARAM_STR);
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->bindParam(':password',$pass,PDO::PARAM_STR);
        $result = $smt->execute();
        return $result;
    }

    function get(array $data) //getDbUsersData
    {
        $smt = $this->pdo->prepare("SELECT * FROM users WHERE name=:name AND email=:email" );
        $smt->bindParam(':name',$data['username'],PDO::PARAM_STR);
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->execute();
        $user = $smt->fetch();
        return $user;
    }

    function logincheck(array $data) //logincheckDbUsersEmail
    {
        $smt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email" );
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->execute();
        $result = $smt->fetch();
        return $result;
    }

    function countname(array $data) //countDbUsersName
    {
        $smt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE name=:name');
        $smt->bindParam(':name',$data['username'],PDO::PARAM_STR);
        $smt->execute();
        $count = $smt->fetchColumn();
        return $count;
    }

    function countemail(array $data) //countDbUsersEmail
    {
        $smt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE email=:email');
        $smt->bindParam(':email',$data['email'],PDO::PARAM_STR);
        $smt->execute();
        $count = $smt->fetchColumn();
        return $count;
    }
}