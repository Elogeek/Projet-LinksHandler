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
    public function addRole(Role $r): bool {
        $request = DB::getInstance()->prepare("INSERT INTO role(name) VALUES(:name)");
        $request->bindValue("name",$r->getName());
        return $request->execute();
    }

    /**
     * Delete a role into the BDD
     * @param Role $r
     * @return bool
     */
    public function deleteRole(Role $r): bool {

        $request = DB::getInstance()->prepare("DELETE FROM role WHERE id = :id");
        $request->bindValue("id", $r->getId());
        return $request->execute();
    }

}