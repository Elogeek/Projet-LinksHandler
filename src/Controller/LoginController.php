<?php
namespace Elogeek\LinksHandler\Controller;

class LoginController extends BaseController {
    /**
     * Redirects into home page
     */
    public function showLogin() {
        self::render("login", "se conecter");
    }
}