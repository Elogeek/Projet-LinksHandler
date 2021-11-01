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
        $controller = filter_var($_GET['controller'], FILTER_SANITIZE_STRING);

        switch($controller) {

            case 'link':
                $controller = new LinkController();
                if(isset($_GET['action'])) {
                    chooseLinksControllerAction($controller, $_GET['action']);
                }
                else {
                    $controller->homeLinks();
                }
                break;

            default:
                $controller = new HomeController();
                $controller->showHome();
        }
    }
    else {
        $controller = new HomeController();
        $controller->showHome();
    }

}


/**
 * Choose the right action to call from links controller.
 */
function chooseLinksControllerAction(LinkController $controller, string $action = null) {

    switch (filter_var($_GET['action'], FILTER_SANITIZE_STRING)) {
        // Add a link
        case 'add':
            $controller->add();
            break;
        // Update a link
        case 'update' :
            if(isset($_GET['id'])) {
                $controller->update((int)$_GET['id']);
            }
            break;
        //Delete a link manque l'id
        case 'delete' :
            $controller->delete();
            break;
        // Disconnect a user pas dans celui-ci
        case 'logout' :
            $controller->logout();
            break;
        // home links
        default :
            $controller->homeLinks();
    }
}
