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

    if (isset($_GET['controller'])) {
        // pas de src ici car Elogeek//LinkHandler => remplace src
        $controller = "Elogeek\\LinksHandler\\Controller\\" . ucfirst(filter_var($_GET['controller'], FILTER_SANITIZE_STRING)) . "Controller";

        if (class_exists($controller)) {

            //echo $controller;
            $controller = new $controller();

            if (isset($_GET['action'])) {
                $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING);

                /*    //switch LinkController

                      $ctrl = new LinkController();

                      switch ($_GET[$ctrl]) {
                          case 'add':
                             $ctrl->add();
                              break;
                          case 'update' :
                             $ctrl->update();
                              break;
                          case 'delete' :
                              $ctrl->delete();
                              break;
                          default :
                              (new HomeController())->showHome();
                       }
                */
                try {
                    if ((new ReflectionClass($controller))->hasMethod($action)) {
                        $controller->$action();
                    }
                } catch (ReflectionException $reflectionException) {
                    echo $reflectionException->getMessage();
                }
            } else {
                (new LinkController())->addLinks();
                (new LinkController())->homeLinks();
            }
        } else {
            (new homeController())->showHome();
        }
    } else {
        (new homeController())->showHome();
    }

}
