<?php
namespace Elogeek\LinksHandler\Model\Manager;

use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Entity\User;

class UserManager {

    /**
     * Add user in the BDD
     * @param User $u
     * @return bool
     */
    public function addUser(User &$u): bool {

        $request = DB::getInstance()->prepare("INSERT INTO prefix_user(nom,prenom,mail,pass)VALUES(:name,:firstname,:mail,:pass)");

        $request->bindValue(":name",$u->getName());
        $request->bindValue(":firstname", $u->getFirstname());
        $request->bindValue(":mail",$u->getMail());
        $request->bindValue(":pass",DB::encodePassword($u->getPass()));

        $result = $request->execute();
        $u->setId(DB::getInstance()->lastInsertId());
        return $result;

    }

    /**
     * Return an user via id
     * @param $mail
     * @return User|null
     */
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