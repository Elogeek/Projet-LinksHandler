<?php

namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\Manager\UserManager;

class UserController extends BaseController {


    /**
     * Redirects into login page
     */
    public function showLogin() {
        $this->render("login");
    }


    /**
     * Login user and create a session
     */
    public function login() {
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        $user = (new UserManager())->searchMail($mail);
        if($user !== null && password_verify($pass, $user->getPass())) {

            $_SESSION['id'] = $user->getId();
            //header("Location: /index.php?error=0");
        }
        else {
            //header("Location: /index.php?error=1");
        }
    }


    /**
     * Disconnect an user
     */
    public function logout() {
        // I'm replacing the $ _SESSION array with an array that contains nothing.
        $_SESSION = [];
        session_unset();
        session_destroy();

        header("Location: /index.php?error=2");
    }

}