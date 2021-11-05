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
        $linkManager = new LinkManager();
        $allLinks = $linkManager->getLinks($_SESSION['user']);
        if($allLinks === null) {
            $allLinks = [];
        }

        $this->render("homeLinks", [
            "links" => $allLinks
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
     * Add a link in the BDD
     */
    public function addLinkFormSubmit(array $request): void {
        // I check if the form is submitted correctly
        // and if the form is well submitted and is well completed then i add it in the database
        if($this->checkFormIsSubmitted() && isset($request['hrefLink'],$request['title'],$request['name'])) {

            $href = filter_var($request['hrefLink'],FILTER_SANITIZE_STRING);
            $title = filter_var($request['title'],FILTER_SANITIZE_STRING);
            $name = filter_var($request['name'],FILTER_SANITIZE_STRING);

            // add user-fk in the BDD
            $userFk = (new Link())->getUserFk();

            $url_status = UrlStatus::get($href);

            // If success
            if($url_status->getStatusCode() === 200) {
                $link = new Link(null, $href, $title,"_blank", $name,$userFk);
                (new LinkManager())->addLink($link);
                $this->setSuccessMessage("Votre lien a bien été ajouté.");
                // if success add link -> redirect to homePageLink
                $this->homeLinks();
            }
            // If error
            else {
                echo"cacao";
                $this->setErrorMessage("Une erreur est survenue en ajoutant le lien");
            }

        }
        // If error
        else {
            echo"cacaoooooo";
            $this->setErrorMessage("Tous les champs doivent être remplis !");
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
    public function deleteFormSubmit (int $linkId, array $request): void {

        $manager = new LinkManager();
        $manager->searchLinks($linkId);
        $manager->deleteLink(filter_var($request['id'], FILTER_SANITIZE_NUMBER_INT));
        // If success request => display homeLink and successMessage
        if($request !== null) {
            $this->setSuccessMessage("Le lien est supprimé.");
            $this->homeLinks();
        }

    }


}