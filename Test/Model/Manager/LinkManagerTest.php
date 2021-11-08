<?php
require __dir__ . '/../../../vendor/autoload.php';


use Elogeek\LinksHandler\Model\Entity\Link;
use Elogeek\LinksHandler\Model\Manager\LinkManager;
use Elogeek\LinksHandler\Model\Manager\UserManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

$linkManager = new LinkManager();
$l = new Link(null, "https://discord.com/channels/764389321947086858/875310065622597652","lien", "_blank","lien",7);


if($linkManager->addLink($l)) {

    echo "lien est bien ajoutée en BDD !\n";
}

else {
    echo "Ouuups,erreur en ajoutant le lien !\n";
    die;
}

// Search a link via id
if($linkManager->searchLinks(1)) {
    echo "je suis là\n";
}
else {
    echo "cherche moi encore\n";
    die;
}

$l = new Link(1, "https://discord.com/channels/764389321947086858/875310065622597652","lien", "_blank","lien",7);
// Modif a link
if($linkManager->updateLink($l)) {
    echo "modif is perfect\n";
}
else {
    echo "ouuuuups\n";
    die;
}

// Delete a link

if($linkManager->deleteLink($linkManager->searchLinks(4))) {

   echo " le dev est un génie\n";
}
else {
    echo "oh ma vache\n";
    die;
}
