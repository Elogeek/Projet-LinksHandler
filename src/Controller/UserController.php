<?php

namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Entity\User;
use Elogeek\LinksHandler\Model\Manager\RoleManager;
use Elogeek\LinksHandler\Model\Manager\UserManager;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

require_once 'public/assets/php/setting.php';

class UserController extends BaseController {

    /**
     * Redirects into login page
     */
    public function showLogin(): void {
        $this->render("login");
    }

    /**
     * Login user and create a session
     */
    public function login(): void {
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        $user = (new UserManager())->searchMail($mail);
        if ($user !== null && password_verify($pass, $user->getPass())) {

            $_SESSION['id'] = true;
            $_SESSION['user'] = $user;
            header("Location: /index.php");
        } else {
            header("Location: /index.php");
        }
    }

    /**
     * Disconnect an user
     */
    public function logout(): void {
        // I'm replacing the $ _SESSION array with an array that contains nothing.
        $_SESSION = [];
        session_unset();
        session_destroy();

        header("Location: /index.php");
    }

    /**
     *  Show  the registration form
     */
    public function displayRegisterUserForm(): void {
        $this->render("register");
    }

    /**
     *  Add a user in the BDD (register a user)
     * @param array $request
     */
    public function registerUserFormSubmit(array $request): void {

        // Checking if form was submit and check that all required fields are defined.
        if($this->checkFormIsSubmitted() && isset($request['firstname'],$request['name'],$request['mail'],$request['pass'],$request['passRepeat'])) {

            // Starting checking provided - required form data.
            $firstname = DB::secureData($request['firstname']);
            $name = DB::secureData($request['name']);
            $mail = DB::secureData($request['mail']);
            $pass = DB::secureData($request['pass']);
            $passwordConfirm = DB::secureData($request['passRepeat']);

            // Check all the data that the user has given
            $userM = new UserManager();

            // If the email address is not taken
            if($this->$userM->searchMail($mail) !== null) {
                $error = true;
                $this->setErrorMessage('Oups, cette adresse email est déjà prise');
            }
            // If the email address is valid
            if(!filter_var($mail,FILTER_VALIDATE_EMAIL)) {
                $error =true;
                $this->setErrorMessage("Le format de l'adresse email n'est pas correct");
            }
            // If the two passwords are identical
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

                // Save new user
                $userM->addUser($user);
                $this->setSuccessMessage("Votre compte a bien été créé.");
                // redirect to homeLinks
                $this->render('homeLinks');
            }
            else {
                $this->render('homeLinks');
                // if error
                $this->setErrorMessage("Une erreur est survenue lors de la création de votre compte.");
            }
        }
        else {
            $this->render('homeLinks');
            $this->setErrorMessage('Tous les champs doivent être remplis');
        }

    }

    public function displayAddContactForm() {
        $this->render('contact');
    }

    /**
     * Send a mail via the library SwiftMailer
     */
    public function sendAnEmail() {

        if($this->checkFormIsSubmitted() && isset($_POST["mail"], $_POST["subject"], $_POST['message'])) {
            // I check if the contact form is correctly submitted and if everything is completed
            $email = DB::secureData($_SESSION['mail']);
            $subject = DB::secureData($_POST['subject']);
            $message = DB::secureData($_POST['message']);
            $message = wordwrap($message, 70, "\r\n");

            // Create the Transport
            $transport = (new Swift_SmtpTransport(EMAIL_HOST,EMAIL_PORT))
                ->setUsername(EMAIL_USERNAME)
                ->setPassword(EMAIL_PASSWORD)
                ->setEncryption(EMAIL_ENCRYPTION) //for gmail
            ;

            // Create the Mailer using your created Transport
                    $mailer = new Swift_Mailer($transport);

            // Create a message
                    // Give the message a subject
                    $message = (new Swift_Message($subject))
                        // The sender of the email
                        ->setFrom([$email])
                        // The email support
                        ->setTo(EMAIL_USERNAME)
                        // The message here
                        ->setBody($message,'text/html')
                    ;

            // Send a mail
            $result = $mailer->send($message);

          header("Location:homeLinks");
          $this->setSuccessMessage("Votre email est bien envoyé au support technique.");
        }
        else {
            header("Location:homeLinks");
            $this->setErrorMessage("Une erreur est survenu lors de l'envoi de l'email.");
        }

    }

}