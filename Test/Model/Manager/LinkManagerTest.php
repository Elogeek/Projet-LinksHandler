<?php
require __dir__ . '/../../../vendor/autoload.php';


use Elogeek\LinksHandler\Model\Entity\User;
use Elogeek\LinksHandler\Model\Manager\LinkManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

$userManager = new User();
$u = new User();



$linkManager = new LinkManager();

$l = new LinkManager(null,"www.youtube.com", "musique","blank","musique");

if($linkManager->addLinks($l)) {
    echo "lien est bien ajoutée en BDD !\n";
}
else {
    echo "Ouuups,erreur en ajoutant le lien !\n";
    die;
}