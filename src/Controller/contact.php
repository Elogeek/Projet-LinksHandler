<?php

use Elogeek\LinksHandler\Model\DB;

if (isset($_POST["mail"], $_POST["subject"], $_POST['message'])) {

    $email = DB::secureData($_POST['mail']);
    $to = "elodiechristin@gmail.com";
    $subject = DB::secureData($_POST['subject']);
    $message = DB::secureData($_POST['message']);
    $message = wordwrap($message, 70, "\r\n");
    $headers = array(
        'Reply-To' => $email,
        'Cc' => 'elodiechristin@gmail.com',
        'X-Mailer' => 'PHP/' . phpversion()
    );

    mail($to, $subject, $message, $headers, "-f " . $email);

    header("Location: ../../index.php?controller=home&page=contact&success=0");
}