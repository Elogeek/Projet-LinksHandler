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

        $request = DB::getInstance()->prepare("INSERT INTO prefix_user(nom,prenom,mail,pass,role_fk)VALUES(:name,:firstname,:mail,:pass,:role)");

        $request->bindValue(":name",$u->getName());
        $request->bindValue(":firstname", $u->getFirstname());
        $request->bindValue(":mail",$u->getMail());
        $request->bindValue(":pass",DB::encodePassword($u->getPass()));
        $request->bindValue(":role",$u->getRole());

        $result = $request->execute();
        $u->setId(DB::getInstance()->lastInsertId());
        return $result;

    }

    /**
     * Return a id user
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User {
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_user WHERE id = :id");
        $request->bindValue(':id', $id);
        $request->execute();
        $user = null;
        if($request->execute() && $data = $request->fetch()) {
            $user = new User($data['id'],$data['nom'],$data['prenom'],$data['mail'],$data['pass'],$data['role']);
        }
        return $user;
    }

    /**
     * Return an user via id
     * @param string $mail
     * @return User|null
     */
    public function searchMail(string $mail): ?User {

        $req =DB::getInstance()->prepare("SELECT * FROM prefix_user WHERE mail = :mail");
        $req->bindValue("mail",$mail);
        $user = null;

        if($req->execute() && $data = $req->fetch()) {
            $user = new User($data['id'],$data['nom'],$data['prenom'],$data['mail'],$data['pass'],$data['role']);
        }
        return $user;
    }

    /**
     * Delete a user into the BDD
     * @param User $u
     * @return bool
     */
    public function deleteUser(User $u): bool {

        $request = DB::getInstance()->prepare("DELETE FROM prefix_user WHERE id = :id");
        $request->bindValue("id", $u->getId());
        return $request->execute();
    }

}