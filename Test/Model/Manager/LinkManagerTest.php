<?php
require __dir__ . '/../../../vendor/autoload.php';

use Elogeek\LinksHandler\Model\Entity\Link;
use Elogeek\LinksHandler\Model\Manager\LinkManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

$linkManager = new LinkManager();
$link = new Link(null,"https://www.youtube.com/watch?v=XFkzRNyygfk&list=RDEMk8jEIzOyB2trfXZrSEVz_Q&start_radio=1","RadioHead","_blank","RadioHead");

if($linkManager->addLinks($link)) {
    echo "lien est bien ajoutée en BDD !\n";
}

else {
    echo "Ouuups,erreur en ajoutant le lien !\n";
    die;
}

// Search a link via id
if($linkManager->searchLinks(4)) {
    echo "je suis là\n";
}
else {
    echo "cherche moi encore\n";
    die;
}

// Modif a link
if($linkManager->updateLink($link)) {
    echo " modif is perfect\n";
}
else {
    echo "ouuuuups\n";
    die;
}

// Delete a link
if($linkManager->deleteLinks($linkManager->searchLinks(4))) {
   echo " le dev est un génie\n";
}
else {
    echo "oh ma vache\n";
    die;
}
