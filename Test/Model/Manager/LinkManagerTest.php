<?php
require __dir__ . '/../../../vendor/autoload.php';

use Elogeek\LinksHandler\Model\Entity\Link;
use Elogeek\LinksHandler\Model\Manager\LinkManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

$linkManager = new LinkManager();
$link = new Link(null,"https://www.youtube.com/watch?v=aUUSz54G6jc&list=RDEM9VJO2EAK2Dznx4RxBs0yLQ&start_radio=1","musique","_blank","musique");

if($linkManager->addLinks($link)) {
    echo "lien est bien ajoutée en BDD !\n";
}

else {
    echo "Ouuups,erreur en ajoutant le lien !\n";
    die;
}