<?php
ini_set('display_errors', 1);
session_start();

//header('location: Controller/login.php');

require_once ('Route/RequestUrl.php');
require_once('Controller/PostController.php');
require_once('Controller/CategoryController.php');
require_once('Controller/TagController.php');
require_once('Controller/UserController.php');

$request = new RequestUrl();
$url = $request->getPathInfo();

// routing

//echo $url;

switch ($url){
    case '/post':
        $postController = new PostController();
        $postController->index();
    break;

    case '/post/add':
        $postController = new PostController();
        $postController->add();
    break;

    case '/list':
        $postController = new PostController();
        $postController->list();
    break;

    case '/post/delete':
        $postController = new PostController();
        $postController->delete();
    break;

    case '/post/edit':
        $postController = new PostController();
        $postController->edit();
    break;

    case '/post/edited':
        $postController = new PostController();
        $postController->edited();
    break;

    case '/search':
        $postController = new PostController();
        $postController->search();
        break;

    case '/category':
        $categoryController = new CategoryController();
        $categoryController->index();
    break;

    case '/category/add':
        $categoryController = new CategoryController();
        $categoryController->add();
    break;

    case '/category/delete':
        $categoryController = new CategoryController();
        $categoryController->delete();
    break;

    case '/category/edit':
        $categoryController = new CategoryController();
        $categoryController->edit();
    break;

    case '/category/edited':
        $categoryController = new CategoryController();
        $categoryController->edited();
    break;

    case '/tag':
        $tagController = new TagController();
        $tagController->index();
    break;

    case '/tag/add':
        $tagController = new TagController();
        $tagController->add();
    break;

    case '/tag/delete':
        $tagController = new TagController();
        $tagController->delete();
    break;

    case '/tag/edit':
        $tagController = new TagController();
        $tagController->edit();
    break;

    case '/tag/edited':
        $tagController = new TagController();
        $tagController->edited();
    break;

    case '/logout':
        $userController = new UserController();
        $userController->logout();
    break;

    case '/register':
        $userController = new UserController();
        $userController->register();
    break;

    case '/login':
        $userController = new UserController();
        $userController->login();
    break;

    default:
        $userController = new UserController();
        $userController->other();
    break;

}
