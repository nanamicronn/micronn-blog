<?php


/**
 * Class Controller
 */
class Controller
{
//    public $userid;
    /**
     * Controller constructor
     */
    function __construct()
    {
        if(!isset($_SESSION['userid'])){
            header("Location: ./login");
            exit;
        }
    }
}