<?php

namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Manager\UserManager;

class UserController extends BaseController {

    /**
     * Redirects into login page
     */
    public function showLogin(): void {
        $this->render("login");
    }

    /**
     * Login user and create a session
     */
    public function login(): void {
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        $user = (new UserManager())->searchMail($mail);
        if ($user !== null && password_verify($pass, $user->getPass())) {

            $_SESSION['id'] = true;
            $_SESSION['user'] = $user;
            header("Location: /index.php");
        } else {
            header("Location: /index.php");
        }
    }

    /**
     * Disconnect an user
     */
    public function logout(): void {
        // I'm replacing the $ _SESSION array with an array that contains nothing.
        $_SESSION = [];
        session_unset();
        session_destroy();

        header("Location: /index.php");
    }

}