<?php

use Elogeek\LinksHandler\Controller\HomeController;
use Elogeek\LinksHandler\Controller\UserController;

require '../vendor/autoload.php';

session_start();

if(!isset($_SESSION['id']) || $_SESSION['id'] !== true) {
    (new UserController())->showLogin();
}
else {

    /*if(isset($_GET['controller'])) {
        $controller = "Elogeek\\LinksHandler\src\Controller\\" . ucfirst(filter_var($_GET['controller'], FILTER_SANITIZE_STRING)) . "Controller";

        if(class_exists($controller)) {
            $controller = new $controller();

            if(isset($_GET['action'])) {
                $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);

              switch
    }*/

}