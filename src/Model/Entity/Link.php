<?php

namespace Elogeek\LinksHandler\Model\Entity;

class Link {

    private ?int $id;
    private ?string $href;
    private ?string $title;
    private ?string $target;
    private ?string $name;

    /**
     * Link constructor.
     * @param int|null $id
     * @param string|null $href
     * @param string|null $title
     * @param string|null $target
     * @param string|null $name
     */
    public function __construct(int $id = null, string $href = null, string $title = null, string $target = null, string $name = null) {
        $this->id = $id;
        $this->href = $href;
        $this->title = $title;
        $this->target = $target;
        $this->name = $name;
    }

    /**
     * Get id of Link
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Link
     */
    public function setId(?int $id): Link {
        $this->id = $id;
        return $this;
    }

    /**
     * Get href of Link
     * @return string|null
     */
    public function getHref(): ?string {
        return $this->href;
    }

    /**
     * Set href of Link
     * @param string|null $href
     * @return Link
     */
    public function setHref(?string $href): Link {
        $this->href = $href;
        return $this;
    }

    /**
     * Get title of Link
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->title;
    }

    /**
     * Set title of Link
     * @param string|null $title
     * @return Link
     */
    public function setTitle(?string $title): Link {
        $this->title = $title;
        return $this;
    }

    /**
     * Get target of Link
     * @return string|null
     */
    public function getTarget(): ?string {
        return $this->target;
    }

    /**
     * Set target of Link
     * @param string|null $target
     * @return Link
     */
    public function setTarget(?string $target): Link {
        $this->target = $target;
        return $this;
    }

    /**
     * Get name of Link
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * Set name of Link
     * @param string|null $name
     * @return Link
     */
    public function setName(?string $name): Link {
        $this->name = $name;
        return $this;
    }



}