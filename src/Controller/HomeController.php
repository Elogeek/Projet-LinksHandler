<?php
namespace Elogeek\LinksHandler\Controller;


use Elogeek\LinksHandler\Model\Manager\LinkManager;

class  HomeController extends BaseController {

    /**
     * Display the homePage
     */
    public function showHome() {
        $links = (new LinkManager())->get();
        self::render("homePage", [$links]);
    }
}