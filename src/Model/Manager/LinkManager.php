<?php

namespace Elogeek\LinksHandler\Model\Manager;

use Elogeek\LinksHandler\Model\DB;
use Elogeek\LinksHandler\Model\Entity\Link;

class LinkManager {

    /**
     * Add an link into the BDD
     * @param Link $l
     * @return bool
     */
    public function addLinks(Link &$l): bool {

        $request = DB::getInstance()->prepare("INSERT INTO prefix_link(href, title, target, name, user_fk)VALUES(:href, :title, :target, :name, :userFk)");

        $request->bindValue(":href",$l->getHref());
        $request->bindValue(":title", $l->getTitle());
        $request->bindValue(":target",$l->getTarget());
        $request->bindValue(":name", $l->getName());
        $request->bindValue(':userFk', $l->getUserFk());

        $result = $request->execute();
        $l->setId(DB::getInstance()->lastInsertId());
        return $result;

    }

    /**
     * Get all links
     * @return array
     */
    public function getLinks(): array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_link");

        if($request->execute() && $result = $request->fetchAll()) {
            foreach($result as $link) {
                $array[] = new Link($link['id'], $link['href'], $link['title'], $link['target'], $link['name'],$link['user_fk']);
            }
        }
        return $array;
    }

    /**
     * Get all links via id
     * @param $id
     * @return Link|null
     */
    public function searchLinks($id): ?Link {
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_link WHERE id = :id");
        $request->bindValue("id", $id);
        $link = null;

        if($request->execute() && $result = $request->fetch()) {
            $link = new Link($result['id'], $result['href'], $result['title'], $result['target'], $result['name'],$result['user_fk']);
        }
        return $link;
    }

    /**
     * Update a link into the BDD
     * @param Link $l
     * @return bool
     */
    public function updateLink(Link $l): bool {

        $request = DB::getInstance()->prepare("UPDATE  prefix_link SET href = :href, title = :title, target = :target, name = :name, user_fk = :userFk WHERE id = :id");
        $request->bindValue("id", $l->getHref());
        $request->bindValue("href", $l->getTitle());
        $request->bindValue("title", $l->getTarget());
        $request->bindValue("target", $l->getName());
        $request->bindValue("name", $l->getId());
        $request->bindValue("user_fk",$l->getUserFk());

        return $request->execute();

    }

    /**
     * Delete a link into the BDD
     * @param Link $l
     * @return bool
     */
    public function deleteLinks(Link $l): bool {

        $request = DB::getInstance()->prepare("DELETE FROM prefix_link WHERE id = :id");
        $request->bindValue("id", $l->getId());
        return $request->execute();
    }

}