<?php

namespace Elogeek\LinksHandler\Model\Manager;

use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Entity\Role;

class RoleManager {

    /**
     * Add a role
     * @param Role $r
     * @return bool
     */
    public function addRole(Role &$r): bool {
        $request = DB::getInstance()->prepare("INSERT INTO role(name) VALUES(:rName)");
        $request->bindValue(":rName",$r->getName());
        $result = $request->execute();
        $r->setId(DB::getInstance()->lastInsertId());
        return $result;
    }

    /**
     * Delete a role into the BDD
     * @param Role $r
     * @return bool
     */
    public function deleteRole(Role $r): bool {

        $request = DB::getInstance()->prepare("DELETE FROM role WHERE id = :id");
        $request->bindValue(":id", $r->getId());
        return $request->execute();
    }

    /**
     *  Returns the id of a role
     * @param $rId
     * @return Role|null
     */
    public function getById($rId): ?Role {
        $request = DB::getInstance()->prepare("SELECT * FROM role WHERE id = :id");
        $request->bindValue(":id",$rId);
        $role = null;
        if($request->execute() && $result = $request->fetch()) {
           $role = new Role($result['id'], $result['name']);
        }

        return $role;
    }

}