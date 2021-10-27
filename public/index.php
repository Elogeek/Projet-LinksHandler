<?php

use Elogeek\LinksHandler\Controller\HomeController;
use Elogeek\LinksHandler\Controller\LinkController;
use Elogeek\LinksHandler\Controller\UserController;

require '../vendor/autoload.php';

session_start();

if( (!isset($_SESSION['id']) || $_SESSION['id'] !== true) && !isset($_POST['login-submit'])) {
    (new UserController())->showLogin();
}

else {

    if(isset($_GET['controller'])) {
        // pas de src ici car Elogeek//LinkHandler => remplace src
        $controller = "Elogeek\\LinksHandler\\Controller\\" . ucfirst(filter_var($_GET['controller'], FILTER_SANITIZE_STRING)) . "Controller";

        if(class_exists($controller)) {
            //echo $controller;
            $controller = new $controller();
            //switch LinkController
            switch ($_GET[$controller]) {
                case 'add':
                    $controller->add();
                    break;
                case 'update' :
                    $controller->update();
                    break;
                case 'updateConfirm' :
                    $controller->updateConfirm();
                    break;
                case 'delete' :
                    $controller->delete();
                    break;
                default :
                    (new HomeController())->showHome();
            }
            if(isset($_GET['action'])) {
                $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);

                try {
                    if((new ReflectionClass($controller))->hasMethod($action)) {
                        $controller->$action();
                    }
                }
                catch (ReflectionException $reflectionException) {
                    echo $reflectionException->getMessage();
                }
            }
            else {
                (new LinkController())->homeLinks();
            }
        }
        else {
            (new HomeController())->showHome();

        }
    }
    else {
        (new HomeController())->showHome();
    }
}