<?php

namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\Manager\UserManager;

class UserController extends BaseController {

    /**
     * Redirects into login page
     */
    public function showLogin() {
        self::render("login", "Connexion");
    }

    /**
     * Login user and create a session
     */
    public function login() {
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        $user = (new UserManager())->searchMail($mail);
        print_r($user);
        if($user !== null && password_verify($pass, $user->getPass())) {
            echo 1;
            $_SESSION['id'] = $user->getId();
            header("Location: /index.php?error=0");
        }
        else {
            header("Location: /index.php?error=1");
        }
    }

    /**
     * Disconnect an user
     */
    public function logout() {
        $_SESSION = array();
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        session_destroy();

        header("Location: /index.php?error=2");
    }

}