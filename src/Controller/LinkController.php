<?php
namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\Entity\Link;
use Elogeek\LinksHandler\Model\Manager\LinkManager;
use Muffeen\UrlStatus\UrlStatus;

class LinkController extends BaseController {

    /**
     * Redirects into addLink page
     */
    public function homeLinks(): void {
       $this->render("addLink");
    }

    /**
     * Display a homePage links
     */
    public function showLinksHome(): void {
        $this->render("links");
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
            (new LinkManager())->addLinks($link);
            header("Location: /index.php");
        }
        else {
            header("Location: /index.php");
        }

    }

    /**
     * Redirects into updateLink page
     */
    public function update() {
        $link = (new LinkManager())->searchLinks(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

      $this->render("updateLink", [$link]);
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
            $link = (new LinkManager())->searchLinks(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
            $link
                ->setHref($href)
                ->setTitle($title)
                ->setName($name);

            (new LinkManager())->updateLink($link);

            header("Location: /index.php");
        }
        else {
            header("Location: /index.php");
        }

    }

    /**
     *  Delete a link in the BDD
     */
    public function delete() {

        (new LinkManager())->deleteLinks(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

        header("Location: /index.php");
    }

}