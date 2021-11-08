<?php
namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Controller\BaseController;
use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Entity\Role;
use Elogeek\LinksHandler\Model\Entity\User;
use Elogeek\LinksHandler\Model\Manager\RoleManager;
use Elogeek\LinksHandler\Model\Manager\UserManager;

class RegisterController extends BaseController {

    public function register(array $request): void {
       // Checking if form was submit and check that all required fields are defined.
       if($this->checkFormIsSubmitted() && isset($request['firstname'],$request['name'],$request['mail'],$request['pass'],$request['passRepeat'])) {

           // Starting checking provided - required form data.
           $firstname = DB::secureData($request['firstname']);
           $name = DB::secureData($request['name']);
           $mail = DB::secureData($request['mail']);
           $pass = DB::secureData($request['pass']);
           $passwordConfirm = DB::secureData($request['passRepeat']);

           //Checking all user inputs
           $userM = new UserManager();

           // Check if the email address is not taken
           if($this->$userM->searchMail($mail) !== null) {
               $error = true;
               $this->setErrorMessage('Oups, cette adresse email est déjà prise');
           }
           // Check if the email address is valid
           if(!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
               $error =true;
               $this->setErrorMessage("Le format de l'adresse email n'est pas correct");
           }
           // Check if the two passwords are identical
            if($pass !== $passwordConfirm || !DB::checkPassword($pass)){
                $error = true;
                $this->setErrorMessage("Les mots de passe ne correspondent pas ou ne respectent pas le critère de sécurité");
            }

           // If no errors were found, then registering user.
           if(!$error) {
               $user = new User();
               $r = new RoleManager();
               $user->setId(null);
               $user->setFirstname($firstname);
               $user->setName($name);
               $user->setMail($mail);
               $user->setPass($pass);
               $user->setRole($this->$r->getById(2));

           // Sauvergarde du new user

            // redirect to homeLinks
       }
    }
}