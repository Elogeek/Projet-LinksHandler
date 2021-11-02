<?php
namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\Entity\Link;
use Elogeek\LinksHandler\Model\Manager\LinkManager;
use Muffeen\UrlStatus\UrlStatus;

class LinkController extends BaseController {

    /**
     * Redirects into addLink page
     */
    public function addLinks(): void {
       $this->render("addLink");
    }

    /**
     * Display a homePage links
     */
    public function homeLinks(): void {
        $this->render("homeLinks");
    }

    /**
     * Redirects into updateLink page
     */
    public function updtLink(): void {
        $link = (new LinkManager())->searchLinks(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
        $this->render("updateLink", [$link]);
    }

    /**
     * Add a link in the BDD
     */
    public function add(): void {

        $href = filter_var($_POST['hrefLink'],FILTER_SANITIZE_STRING);
        $title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
        $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

        $url_status = UrlStatus::get($href);

        if($url_status->getStatusCode() === 200) {
            $link = new Link(null, $href, $title,"_blank", $name);
            (new LinkManager())->addLinks($link);
            // if add link => display homePageLink
            $this->homeLinks();
        }
        else {
            // if not add link => redirect to index
            header("Location: /index.php");
        }

    }

    /**
     * Update a link into the BDD
     */
    public function update(int $linkId): void {

        $manager = new LinkManager();
        $link = $manager->searchLinks($linkId);

        if($link !== null) {
            $href = filter_var($_POST['hrefLink'], FILTER_SANITIZE_STRING);
            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $url_status = UrlStatus::get($href);

            if ($url_status->getStatusCode() === 200) {
                $link = $manager->searchLinks(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
                $link
                    ->setHref($href)
                    ->setTitle($title)
                    ->setName($name);

                (new LinkManager())->updateLink($link);
                // If ok update => display homeLinks
                $this->homeLinks();
            } else {
                // If not update => display index
                header("Location: /index.php");
            }
        }
        else {
            // The link does not exists.
            header("Location: /index.php");
        }

    }

    /**
     *  Delete a link in the BDD
     */
    public function delete(int $linkId): void {

    $manager = new LinkManager();
    $manager->searchLinks($linkId);
    $manager ->deleteLinks(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
    header("Location: /index.php");

    }

}