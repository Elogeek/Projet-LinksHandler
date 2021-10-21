<?php

class User{
    private ?int $id;
    private ?string $name;
    private ?string $firstname;
    private ?string $mail;
    private ?string $pass;

    /**
     * Links constructor.
     * @param int|null $id
     * @param string|null $name
     * @param string|null $firstname
     * @param string|null $mail
     * @param string|null $pass
     */
    public function __construct(int $id = null, string $name = null, string $firstname = null, string $mail = null, string $pass = null) {
        $this->id = $id;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->mail = $mail;
        $this->pass = $pass;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return User
     */
    public function setName(?string $name): User {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return User
     */
    public function setFirstname(?string $firstname): User {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string {
        return $this->mail;
    }

    /**
     * @param string|null $mail
     * @return User
     */
    public function setMail(?string $mail): User {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPass(): ?string {
        return $this->pass;
    }

    /**
     * @param string|null $pass
     * @return User
     */
    public function setPass(?string $pass): User {
        $this->pass = $pass;
        return $this;
    }

}
