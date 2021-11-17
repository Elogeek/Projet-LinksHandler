<?php

namespace Elogeek\LinksHandler\Controller;

use Elogeek\LinksHandler\ConfigFile\Configs;
use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Entity\User;
use Elogeek\LinksHandler\Model\Manager\LinkManager;
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
        }
        header("Location: /index.php");
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
     *  Display user link statistics in graphic
     */
    public function getGraphStatLinks(): void {
        $this->render("graphics");
        // si l'utilisateur est connecté donc n'est pas null alors affiche le graphic
        if ($_SESSION['user'] !== null) {
             $this->getStatGraph();
        }
    }

    /**
     * Return all data of user
     */
    public function getStatGraph(): array {
        $allLinks = (new LinkManager())->getLinks($_SESSION['user']);
        $arrayLinks = [];
        foreach($allLinks as $link) {
            $arrayLinks[] = ["id" => $link->getId(), "href" => $link->getHref(), "title" => $link->getTitle(), "name" => $link->getName(), "img" => $link->getImg(), "click" => $link->getClick()];
        }
        return $arrayLinks;
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

            // If the email address is valid
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $this->setErrorMessage("Le format de l'adresse email n'est pas correct");
            }
            // If the email address is not taken
            elseif($userM->searchMail($mail) !== null) {
                $this->setErrorMessage('Oups, cette adresse email est déjà prise');
            }
            else {
                // If the two passwords are identical
                if ($pass === $passwordConfirm && DB::checkPassword($pass)) {
                    $user = new User();
                    $r = new RoleManager();
                    $user->setId(null);
                    $user->setFirstname($firstname);
                    $user->setName($name);
                    $user->setMail($mail);
                    $user->setPass($pass);
                    $user->setRole($r->getById(2)->getId());

                    // Save new user
                    if($userM->addUser($user)) {
                        // Stock user in the SESSION
                        $_SESSION['user'] = $user;
                        $this->setSuccessMessage("Votre compte a bien été créé.");
                    }
                    else {
                        $this->setErrorMessage("Impossible d'enregistrer cet utilisateur");
                    }
                }
                else {
                    $this->setErrorMessage("Les mots de passe ne correspondent pas ou ne respectent pas le critère de sécurité");
                }
            }
            // in all other cases === display homeLinks
            (new LinkController())->homeLinks();
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
            $message = DB::secureData($_POST['message'] && wordwrap($message,70,"\r\n"));

            // create instance de la classe PhpMailer (true === activation execptions)
            $mail = new PHPMailer(True);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = Configs::HOST;
                $mail->SMTPAuth = true;
                $mail->Username = Configs::USERNAME;
                $mail->Password =  Configs::PASSWORD;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                $mail->setFrom($senderMail);
                $mail->addAddress('supportTechniqueLK@gmail.com','support technique Link-Handler');

                //Content of the email, and set email format to HTML
                $mail->isHTML(true);
                $mail->Subject = $subjectMail;
                $mail->Body = $message;
                //send a mail
               if($mail->send()) {
                   // If success ==> display homeLinks with messageSuccess
                   $this->setSuccessMessage("Votre email est bien envoyé au support technique.");
               }
            }
            // If error ===> display homeLinks with messageError
            catch (Exception $e) {
                echo "Erreur l'email n'est pas envoyé" .'Mailer Error: ' . $mail->ErrorInfo;
                $this->setErrorMessage("Une erreur est survenu lors de l'envoi de l'email.");
            }

        }
        // In all other cases === display homeLinks
        else {
            (new LinkController())->homeLinks();
        }

    }

}
