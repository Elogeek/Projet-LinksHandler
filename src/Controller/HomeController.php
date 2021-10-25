<?php
namespace Elogeek\LinksHandler\Controller;


use Elogeek\LinksHandler\Model\Manager\LinkManager;

class  HomeController extends BaseController {

    /**
     * Display the homePage
     */
    public function showHome(): void
    {
        $links = (new LinkManager())->getLinks();
        $this->render("homePage", [$links]);
    }
}