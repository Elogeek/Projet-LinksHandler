<?php
namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\Entity\Link;
use Elogeek\LinksHandler\Model\Manager\LinkManager;
use Muffeen\UrlStatus\UrlStatus;

class LinkController extends BaseController {

    /**
     * Redirects into addLink page (display form add a link)
     */
    public function displayAddLinkForm(): void {
        $this->render("addLink");
    }

    /**
     * Display a homePage links
     */
    public function homeLinks(): void {
        $this->render("homeLinks", [
            "links" => (new LinkManager())->getLinks($_SESSION['user']) ?? []
        ]);
    }

    /**
     * Redirects into updateLink page (display form update a link)
     */
    public function displayUpdateLinkForm(): void {
        $link = (new LinkManager())->searchLinks(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
        $this->render("updateLink", [
            "link" => $link
        ]);
    }

    /**
     * Redirect to deleteLinkPage
     */
    public function displayDeleteLinkForm(): void {
        $link = (new LinkManager())->searchLinks(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));
        $this->render("deleteLink", [
            "link" => $link
        ]);
    }

    /**
     * Add a link in the BDD
     */
    public function addLinkFormSubmit(array $request): void {
        // I check if the form is submitted correctly
        // and if the form is well submitted and is well completed then i add it in the database
        if($this->checkFormIsSubmitted() && isset($request['hrefLink'],$request['title'],$request['name'])) {

            $href = filter_var($request['hrefLink'],FILTER_SANITIZE_STRING);
            $title = filter_var($request['title'],FILTER_SANITIZE_STRING);
            $name = filter_var($request['name'],FILTER_SANITIZE_STRING);
            $url_status = UrlStatus::get($href);

            // If success
            if($url_status->getStatusCode() === 200) {
                // Search user connect via the variable $_SESSION['user']
                $user = $_SESSION['user'];
                $link = new Link(null, $href, $title,"_blank", $name, $user->getId());
                (new LinkManager())->addLink($link);
                $this->setSuccessMessage("Votre lien a bien été ajouté.");
                // if success add link -> redirect to homePageLink
                $this->homeLinks();
            }
            // If error
            else {

                $this->setErrorMessage("Une erreur est survenue en ajoutant le lien");

                // $this->homeLinks();

            }

        }
        // If error
        else {

            $this->setErrorMessage("Tous les champs doivent être remplis !");

            // $this->homeLinks();

        }
    }


    /**
     * Update a link into the BDD
     */
    public function updateFormSubmit (int $linkId, array $request): void {
        // First I look for the id of the link I want to modify
        $manager = new LinkManager();

        // I check if the form is submitted correctly
        if($this->checkFormIsSubmitted() && isset($request['hrefLink'],$request['title'],$request['name'])) {
            // If the form is well submitted and is well completed then I add the changes in the database
            $href = filter_var($request['hrefLink'], FILTER_SANITIZE_STRING);
            $title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $name = filter_var($request['name'], FILTER_SANITIZE_STRING);
            $url_status = UrlStatus::get($href);

            if ($url_status->getStatusCode() === 200) {
                $link = $manager->searchLinks($linkId);
                if($link !== null) {
                    $link
                        ->setHref($href)
                        ->setTitle($title)
                        ->setName($name);

                    $manager->updateLink($link);
                    $this->setSuccessMessage("Le lien est mis à jour.");
                }
                else {
                    $this->setErrorMessage("Le lien n'a pas été trouvé");
                }
                // If ok update => display homeLinks
                $this->homeLinks();
            }
        }
        else {
            // If error => display homeLinks
            $this->homeLinks();
            $this->setErrorMessage("Un problème avec le lien est survenu");
        }

    }

    /**
     *  Delete a link in the BDD
     */
    public function deleteFormSubmit(int $linkId): void {
        // First I will look for the id of my link
        $manager = new LinkManager();
        $link = $manager->searchLinks($linkId);

        // If the form is submitted and the id of my link is not null
        if($this->checkFormIsSubmitted() && $link) {
            // So I remove the link
            $manager->deleteLink($link);
            // If success request => so i display the homeLinks
            $this->homeLinks();
        }
        $this->homeLinks();
    }

}