<?php

namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\DB;

class RegisterController extends BaseController
{
    /**
     * Display the registration form
     */
    public function register(): void
    {
        $this->render('register');
    }

    public function displayFormRegistrationUser(): void
    {
        $this->render('register');
    }

    public function addGeekFormSubmit(array $request): void {
        // Check a form is submitted correctly
        if ($this->checkFormIsSubmitted() && (isset($request["lastname"], $request['name'], $request["mail"], $request["pass"], $request['passRepeat']))) {

            $lastname = DB::secureData($request["lastname"]);
            $name = DB::secureData($request['name']);
            $mail = DB::secureData($request["mail"]);
            $pass = DB::secureData($request["pass"]);
            $passRepeat = DB::secureData($request['passRepeat']);

            // I encrypt the password.
            $encryptedPassword = DB::encodePassword($pass);
            // Check correspondance passwords
            // Check if email is not in use and if mail is valid.
            //addUser if success
            // If success add user =>redirect to homePageLink
            (new LinkController())->homeLinks();
            // If error
        else{
                $this->setErrorMessage("une erreur est survenue lors de votre inscription");
            }
        }
        // If error
        else{
            $this->setErrorMessage("Tous les champs doivent être remplis lors de votre inscription !");
        }

    }


}