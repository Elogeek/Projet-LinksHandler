<?php
namespace Elogeek\LinksHandler\src\Controller;

use Elogeek\LinksHandler\Controller\BaseController;
use Elogeek\LinksHandler\src\Manager\LinkManager;

class  HomeController extends BaseController {

    /**
     * Redirects into home page
     */
    public function showHome() {
        $links = (new LinkManager())->get();
        self::render("homePage", "Accueil", [$links]);
    }
}