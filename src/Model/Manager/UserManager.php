<?php
namespace Elogeek\LinksHandler\Model\Manager;

use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Entity\User;

class UserManager {

    /** Add user in the BDD
     * @param User $u
     * @return bool
     */
    public function add(User $u): bool {

        $name = $u->getName();
        $firstName = $u->getFirstname();
        $mail = $u->getMail();
        $pass = $u->getPass();

        $request = DB::getInstance()->prepare("INSERT INTO prefix_user(non,prenom,mail,pass)VALUES(:name,:firstName,:mail,:pass)");
        $request->bindValue("name",$name);
        $request->bindValue('firstname',$firstName);
        $request->bindValue("mail",$mail);
        $request->bindValue("pass",$pass);

        if($request->execute()){
            return true;
        }
        return false;
    }

    public function searchMail($mail): ?User {

        $req =DB::getInstance()->prepare("SELECT * FROM prefix_user WHERE mail = :mail");
        $req->bindValue("mail",$mail);
        $user = null;

        if($req->execute() && $data = $req->fetch()) {
            $user = new User($data['id'],$data['nom'],$data['prenom'],$data['mail'],$data['pass']);
        }
        return $user;
    }

}