<?php
namespace Elogeek\LinksHandler\Controller;


use Elogeek\LinksHandler\Model\Manager\LinkManager;

class  HomeController extends BaseController {

    /**
     * Redirects into home page
     */
    public function showHome() {
        $links = (new LinkManager())->get();
        self::render("homePage", "Accueil", [$links]);
    }
}