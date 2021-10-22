<?php
namespace Elogeek\LinksHandler\src\Controller;


require '../vendor/autoload.php';

session_start();

if(isset($_GET['controller'])) {
    $controller = "Elogeek\\LinksHandler\src\Controller\\" . ucfirst(filter_var($_GET['controller'], FILTER_SANITIZE_STRING)) . "Controller";

    if(class_exists($controller)) {
        $controller = new $controller();

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
            $controller->showHome();
        }
    }
    else {
        (new HomeController())->showHome();
    }
}
else {
    (new HomeController())->showHome();
}