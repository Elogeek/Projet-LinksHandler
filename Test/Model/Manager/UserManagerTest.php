<?php
require __dir__ . '/../../../vendor/autoload.php';

use Elogeek\LinksHandler\Model\Entity\User;
use Elogeek\LinksHandler\Model\Manager\UserManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

echo "hello";

$userManager = new UserManager();
$user = new User(null, 'Elogeek', 'Elo','elo@gmail.com','123Azerty');

if($userManager->addUser($user)) {
    echo "l'utilisateur est bien ajoutée en BDD !\n";
}
else {
    echo "Ouuups,erreur en ajoutant l'utilisateur !\n";
    die;
}