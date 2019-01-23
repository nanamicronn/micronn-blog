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

//        $kari = Csrf::check();
//        var_dump($kari);
        if(!isset($_SESSION['userid'])){
            header("Location: ./login");
            exit;
        }
    }
}