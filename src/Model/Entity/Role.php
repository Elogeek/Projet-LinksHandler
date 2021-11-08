<?php

namespace Elogeek\LinksHandler\Model\Entity;

class Role {

    private ?int $id;
    private ?string $name;

    /**
     *  Role construct
     * @param int|null $id
     * @param string|null $name
     */
    public function __construct(int $id = null, string $name = null){
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Role|null
     */
    public function setId(?int $id): ?Role {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Role|null
     */
    public function setName(?string $name): ?Role {
        $this->name = $name;
        return  $this;
    }

}