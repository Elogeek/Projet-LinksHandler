<?php

use Elogeek\LinksHandler\Controller\HomeController;
use Elogeek\LinksHandler\Controller\LinkController;
use Elogeek\LinksHandler\Controller\UserController;
use Elogeek\LinksHandler\Model\Entity\User;

require '../vendor/autoload.php';

session_start();

if( (!isset($_SESSION['id']) || $_SESSION['id'] !== true) && !isset($_POST['login-submit'])) {
    (new UserController())->showLogin();
}

else {

    $user = $_SESSION['user'];

    if (isset($_GET['controller'])) {
        // pas de src ici car Elogeek//LinkHandler => remplace src
        $controller = "Elogeek\\LinksHandler\\Controller\\" . ucfirst(filter_var($_GET['controller'], FILTER_SANITIZE_STRING)) . "Controller";

        if (class_exists($controller)) {

            //echo $controller;
            $controller = new $controller();

            if (isset($_GET['action'])) {
                $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);

                //switch Controller

                switch ($_GET['action']) {
                    case 'add':
                        $controller->add();
                        break;
                    case 'update' :
                        $controller->update();
                        break;
                    case 'delete' :
                        $controller->delete();
                        break;
                    case 'logout' :
                        $controller->logout();
                        break;
                    default :
                        $controller->showHome();
                }
            }

        $controller->showHome();
        }

    }

}
