<?php
require __dir__ . '/../../../vendor/autoload.php';

use Elogeek\LinksHandler\Model\Entity\Role;
use Elogeek\LinksHandler\Model\Manager\RoleManager;


ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

// Add a role
$roleManager = new RoleManager();
$role = new Role(null,"roleTest");
if($roleManager->addRole($role)) {
    echo "Le rôle est bien ajouté\n";
}
else {
    "Erreur, le rôle n'est pas ajoutée\n";
    die;
}

// Return id de roleTest
if($roleManager->getById(3)) {
    echo "super, j'ai trouvé l'id\n";
}
else {
    "je me suis perdue\n";
    die;
}

// Delete a role
if($roleManager->deleteRole($roleManager->getById(5))) {
    echo "rôle supprimé\n";
}
else {
    echo "rôle non supprimé\n";
    die;
}

