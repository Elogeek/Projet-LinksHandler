<?php
namespace Elogeek\LinksHandler\Controller;


use Elogeek\LinksHandler\Model\Entity\User;
use Elogeek\LinksHandler\Model\Manager\LinkManager;

class  HomeController extends BaseController {

    /**
     * Display the homePage
     */
    public function showHome(User $user = null): void {

            $links = [];
            if($user !== null) {
                $links = (new LinkManager())->getLinks($user);
            }
            $this->render("homePage", [$links]);
        }

    }