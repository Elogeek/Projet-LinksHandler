<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Elogeek\LinksHandler\Controller\LinkController;
use Elogeek\LinksHandler\Controller\UserController;
use Elogeek\LinksHandler\Controller\RegisterController;
use Elogeek\LinksHandler\Model\Entity\User;


require '../vendor/autoload.php';

session_start();

if ((!isset($_SESSION['id']) || $_SESSION['id'] !== true) && !isset($_POST['login-submit'])) {
    (new UserController())->showLogin();
}
else {
    $user = $_SESSION['user'];

    if (isset($_GET['controller'])) {
        $controller = filter_var($_GET['controller'], FILTER_SANITIZE_STRING);

        switch ($controller) {

            case 'link':
                $controller = new LinkController();
                if (isset($_GET['action'])) {
                    chooseLinksControllerAction($controller);
                } else {
                    $controller->homeLinks();
                }
                break;

            // Connect or disconnect a user via la fct routeUser
            case 'user':
                if (isset($_GET['action'])) {
                    $controller = new UserController();
                    routeUser($controller);
                    break;
                }

            // Action registers a user
            case 'register':
                if (isset($_GET['action'])) {
                    $controller = new RegisterController();
                    routeRegister($controller);
                    break;
                }

            default:
                $controller = new LinkController();
                $controller->homeLinks();
        }
    } else {
        $controller = new LinkController();
        $controller->homeLinks();

    }
}


/**
 * Choose the right action to call from links controller.
 */
function chooseLinksControllerAction(LinkController $controller) {

    switch (filter_var($_GET['action'], FILTER_SANITIZE_STRING)) {
        // Add a link
        case 'add':
            $controller->addLinkFormSubmit($_POST);
            break;
        // Display form addLink
        case 'display-add-link-form':
            $controller->displayAddLinkForm();
            break;

        // Update a link
        case 'update' :
            if (isset($_GET['id'])) {
                $controller->updateFormSubmit((int)$_GET['id'], $_POST);
            }
            break;
        // Display form update a link
        case 'display-update-link-form' :
            $controller->displayUpdateLinkForm();
            break;
        //Delete a link
        case 'delete' :
            if (isset($_GET['id'])) {
                $controller->deleteFormSubmit((int)$_GET['id']);
            }
            break;
        // Display form delete a link
        case 'display-delete-link-form' :
            $controller->displayDeleteLinkForm();
            break;
        // Display homeLinks by default
        default :
            $controller->homeLinks();
    }
}


/**
 * If connect / if disconnect a user
 * @param UserController $controller
 */
function routeUser(UserController $controller) {

    switch (filter_var($_GET['action'], FILTER_SANITIZE_STRING)) {
        case 'logout' :
            $controller->logout();
            break;
        default :
            $controller->login();

    }

}


/**
 * Router of the RegisterController
 * @param RegisterController $controller
 */
function routeRegister(RegisterController $controller) {
        switch (filter_var($_GET['action'], FILTER_SANITIZE_STRING)) {
            // Action register an user
            case 'register':
                  $controller->registerUserFormSubmit($_POST);
                    break;
            // Display the registration form
            case 'display-register-user-form':
                $controller->displayRegisterUserForm();
                break;
            default :
                break;
        }
    }

    function routeContact(ContactController $controller) {
        switch (filter_var($_GET['action'],FILTER_SANITIZE_STRING)) {
            case'display-add-contact-form':
                $controller->displayAddContactForm();
                    break;
            case 'contact':
                $controller->contact($_POST);
                break;
            default:
                break;
        }
    }