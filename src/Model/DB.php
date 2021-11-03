<?php

namespace Elogeek\LinksHandler\Model;

use PDO;
use PDOException;

class DB {

    private string $host = 'localhost';
    private string $db = 'links';
    private string $user = 'dev';
    private string $password = 'dev';
    private static ?PDO $dbInstance = null;

    /**
     * DB constructor.
     */
    public function __construct() {
        try {
            self::$dbInstance = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->password);
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$dbInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erreur: " . $exception->getMessage();
        }
    }

    /**
     * Return a new instance or an instance
     * @return PDO|null
     */
    public static function getInstance(): ?PDO {
        if(null === self::$dbInstance) {
            new self();
        }
        return self::$dbInstance;
    }

    /**
     * the secureData fct returns secure data and insert it into the database.
     * @param $data
     * @return string
     */

    public static function secureData($data): string {
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        $data = addslashes($data);
        return trim($data);
    }

    /**
     * Encode a given plain password
     * @param $plainPassword
     * @return string
     */
    public static function encodePassword($plainPassword): string {
        // Encoding password.
        $password = self::secureData($plainPassword);
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Check if password is correct
     * Check if the password contains uppercase, lowercases, numbers at least 5 characters.
     * @param $psswd
     * @return bool
     */
    public static function checkPassword($psswd): bool {
        $majuscule = preg_match('@[A-Z]@', $psswd);
        $minuscule = preg_match('@[a-z]@', $psswd);
        $number = preg_match('@[0-9]@', $psswd);

        if(!$majuscule || !$minuscule || !$number || strlen($psswd) < 5 ) {
            return false;
        }

        return true;
    }

    /**
     * avoid clone by another dev
     */
    public function __clone() {}

}