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
    public function add(Link $l): bool{
        $href = $l->getHref();
        $title = $l->getTitle();
        $target = $l->getTarget();
        $name = $l->getName();

        $request = DB::getInstance()->prepare("INSERT INTO prefix_link(href, title, target, name)  VALUES(:href, :title, :target, :name)");
        $request->bindValue("href", $href);
        $request->bindValue("title", $title);
        $request->bindValue("target", $target);
        $request->bindValue("name", $name);

        if( $request->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Get all links
     * @return array
     */
    public function get(): array {
        $array = [];
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_link");

        if($request->execute() && $result = $request->fetchAll()) {
            foreach($result as $link) {
                $array[] = new Link($link['id'], $link['href'], $link['title'], $link['target'], $link['name']);
            }
        }
        return $array;
    }

    /**
     * Get all links via id
     * @param $id
     * @return Link|null
     */
    public function search($id): ?Link {
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_link WHERE id = :id");
        $request->bindValue("id", $id);
        $link = null;

        if($request->execute() && $result = $request->fetch()) {
            $link = new Link($result['id'], $result['href'], $result['title'], $result['target'], $result['name']);
        }
        return $link;
    }

    /**
     * Update a link into the BDD
     * @param Link $l
     * @return bool
     */
    public function update(Link $l): bool {
        $id = $l->getId();
        $href = $l->getHref();
        $title = $l->getTitle();
        $target = $l->getTarget();
        $name = $l->getName();

        $request = DB::getInstance()->prepare("UPDATE  prefix_link SET href = :href, title = :title, target = :target, name = :name WHERE id = :id");
        $request->bindValue("id", $id);
        $request->bindValue("href", $href);
        $request->bindValue("title", $title);
        $request->bindValue("target", $target);
        $request->bindValue("name", $name);

        if($request->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Delete a link into the BDD
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        $request = DB::getInstance()->prepare("DELETE FROM prefix_link WHERE id = :id");
        $request->bindValue("id", $id);

        if($request->execute()) {
            return true;
        }
        return false;
    }

}