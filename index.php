<?php
ini_set('display_errors', 1);

//header('location: Controller/login.php');

require_once ('Route/RequestUrl.php');
require_once('Controller/PostController.php');
//require_once ('Controller/login.php');
//require_once ('Controller/register.php');

$request = new RequestUrl();
$url = $request->getPathInfo();

// routing

echo $url;

switch ($url){
    case '/post':
        $postController = new PostController();
        $postController->index();
    break;

    case '/post/add';
        $postController = new PostController();
        $postController->add();
    break;

    case '/list';
        $postController = new PostController();
        $postController->list();
    break;

    case '/delete';
        $postController = new PostController();
        $postController->delete();
    break;



}

//$ur = $request->