<?php
require __dir__ . '/../../../vendor/autoload.php';


use Elogeek\LinksHandler\Model\Entity\Link;
use Elogeek\LinksHandler\Model\Manager\LinkManager;
use Elogeek\LinksHandler\Model\Manager\UserManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

$userManager = new UserManager();
$user = $userManager->getById(7);

$linkManager = new LinkManager();
$l = new Link();

if($linkManager->getLinks($l->getUserFk($user))) {
  print_r($linkManager) ;
}

else {
    echo "Ouuups !\n";
    die;
}
/*
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
*/