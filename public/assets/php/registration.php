<?php

use Elogeek\LinksHandler\Model\DB;

if (isset($_POST["lastname"], $_POST['name'],$_POST["mail"], $_POST["pass"], $_POST['passRepeat'])) {

    $lastname = DB::secureData($_POST["lastname"]);
    $name = DB::secureData($_POST['name']);
    $mail = DB::secureData($_POST["mail"]);
    $password = DB::secureData($_POST["pass"]);
    $passwordR = DB::secureData($_POST['passRepeat']);

    // I encrypt the password.
    $encryptedPassword = DB::encodePassword($password);

    $request = DB::getInstance()->prepare("SELECT * FROM prefix_user WHERE mail = :mail");
    $request->bindParam(":mail", $mail);
    $result = $request->execute();

    if ($result) {
        $user = $request->fetch();
        // Checks if email is not in use.
        if ($user['mail'] === $mail) {
            header("Location: ../../index.php?controller=home&page=registration&error=0");
        }
        // Check if the email address is valid.
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

            // Check if the 2 entered passwords are identical
            if ($password === $passwordR) {
                // Check if password is correct contains at least 5 characters.
                $password = DB::checkPassword($passwordR);

                $request = DB::getInstance()->prepare("INSERT INTO prefix_user (nom,prenom, mail, pass, role_fk) 
                    VALUES (:lastname, :name, :mail, :pass, :role_fk)");

                $request->bindValue(':lastname', $lastname);
                $request->bindValue(':name', $name);
                $request->bindValue(':mail', $mail);
                $request->bindValue(':pass', $encryptedPassword);
                // People who register automatically have role 2 : user.
                $request->bindValue(':role_fk', 2);
                $request->execute();

                header("Location: ../../index.php");
            }
            else {
                header("Location: ../../index.php");
            }
        }
    }

}