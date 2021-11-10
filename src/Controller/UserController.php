<?php

namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\ConfigFile\Configs;
use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Entity\User;
use Elogeek\LinksHandler\Model\Manager\RoleManager;
use Elogeek\LinksHandler\Model\Manager\UserManager;

// Lance les classes PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


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
        if ($this->checkFormIsSubmitted() && isset($request['firstname'], $request['name'], $request['mail'], $request['pass'], $request['passRepeat'])) {

            // Starting checking provided - required form data.
            $firstname = DB::secureData($request['firstname']);
            $name = DB::secureData($request['name']);
            $mail = DB::secureData($request['mail']);
            $pass = DB::secureData($request['pass']);
            $passwordConfirm = DB::secureData($request['passRepeat']);

            // Check all the data that the user has given
            $userM = new UserManager();

            // If the email address is not taken
            if ($this->$userM->searchMail($mail) !== null) {
                $iAmError = true;
                $this->setErrorMessage('Oups, cette adresse email est déjà prise');
                echo 'cacao';
            }
            // If the email address is valid
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $iAmAError = true;
                $this->setErrorMessage("Le format de l'adresse email n'est pas correct");
                echo 'cacaoChaud';
            }
            // If the two passwords are identical
            if ($pass !== $passwordConfirm || !DB::checkPassword($pass)) {
                $iAmAError = true;
                $this->setErrorMessage("Les mots de passe ne correspondent pas ou ne respectent pas le critère de sécurité");
                echo 'cacaoOla';

                // If no errors were found, then registering user.
                if (!$iAmAError) {
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
                } else {
                    $this->render('homeLinks');
                    // if error
                    $this->setErrorMessage("Une erreur est survenue lors de la création de votre compte.");
                }
            } else {
                $this->render('homeLinks');
                $this->setErrorMessage('Tous les champs doivent être remplis');
            }

        }

    }


    /**
     * Display a registration form of the site
     */
    public function displayContactForm(): void {
            $this->render('contact');
        }

    /**
     * Send a mail via the library SwiftMailer
     */
    public function sendAnEmail(string $subjectMail, string $message,string $senderMail): void {

        if ($this->checkFormIsSubmitted() && isset($_POST["mail"], $_POST["subject"], $_POST['message'])) {
            // I check if the contact form is correctly submitted and if everything is completed
            $senderMail = DB::secureData($_SESSION['mail']);
            $subjectMail = DB::secureData($_POST['subject']);
            $message = DB::secureData($_POST['message']);
            $message = wordwrap($message, 70, "\r\n");

            // create instance de la classe PhpMailer (true === activation execptions)
            $mail = new PHPMailer(True);

            try {
                //Server settings
                //Enable verbose debug output
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                //Send using SMTP
                $mail->isSMTP();
                //Set the SMTP server to send through
                $mail->Host = Configs::HOST;
                // Enable SMTP authentication
                $mail->SMTPAuth = true;
                //SMTP username (=== The sending email address)
                $mail->Username = Configs::USERNAME;
                //SMTP password (=== the password of the sending email address)
                $mail->Password =  Configs::PASSWORD;
                //Enable implicit TLS encryption
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->Port = 465;

                // The recipient
                $mail->setFrom('supportTechnique@example.com', 'Administrateur');
                // Customize the sender
                $mail->addAddress($senderMail);

                //Content of the email

                //Set email format to HTML
                $mail->isHTML(true);
                $mail->Subject = $subjectMail;
                $mail->Body = $message;
                //send a mail
               if($mail->send()) { }
                echo "Le message a bien été envoyé !";
            }
            catch (Exception $e) {
                echo "Erreur l'email n'est pas envoyé" .'Mailer Error: ' . $mail->ErrorInfo;
            }
            // If success ==> display homeLinks with messageSuccess
            header("Location:homeLinks");
            $this->setSuccessMessage("Votre email est bien envoyé au support technique.");
        }
        // If error ===> display homeLinks with messageError
        else {
            header("Location:homeLinks");
            $this->setErrorMessage("Une erreur est survenu lors de l'envoi de l'email.");
        }

    }
}
