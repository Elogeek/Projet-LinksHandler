<?php
namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\Entity\Link;
use Elogeek\LinksHandler\Model\Manager\LinkManager;
use Muffeen\UrlStatus\UrlStatus;

class LinkController extends BaseController {

    /**
     * Redirects into addLink page
     */
    public function home() {
        self::render("addLink", "Ajout du lien");
    }

    /**
     * Add a link in the BDD
     */
    public function add() {

        $href = filter_var($_POST['hrefLink'],FILTER_SANITIZE_STRING);
        $title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
        $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

        $url_status = UrlStatus::get($href);

        if($url_status->getStatusCode() === 200) {
            $link = new Link(null, $href, $title,"_blank", $name);
            (new LinkManager())->add($link);
            header("Location: /index.php?error=3");
        }
        else {
            header("Location: /index.php?error=6");
        }

    }

    /**
     * Redirects into updateLink page
     */
    public function update() {
        $link = (new LinkManager())->search(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

        self::render("updateLink", "Modifier de lien", [$link]);
    }

    /**
     * Update a link into the BDD
     */
    public function updateConfirm() {

        $href = filter_var($_POST['hrefLink'], FILTER_SANITIZE_STRING);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $url_status = UrlStatus::get($href);

        if($url_status->getStatusCode() === 200) {
            $link = (new LinkManager())->search(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
            $link
                ->setHref($href)
                ->setTitle($title)
                ->setName($name);

            (new LinkManager())->update($link);

            header("Location: /index.php?error=4");
        }
        else {
            header("Location: /index.php?error=6");
        }

    }

    /**
     *  Delete a link inthe BDD
     */
    public function delete() {

        (new LinkManager())->delete(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

        header("Location: /index.php?error=5");
    }

}