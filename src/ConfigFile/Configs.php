<?php

namespace Elogeek\LinksHandler\ConfigFile;

/**
 * Class config
 * Configuration file => settings to send an email with PHPMailer
 */

class Configs {
    public const HOST = "localhost";
    public const DB_NAME = "links";
    public const USERNAME = "dev";
    public const PASSWORD = "dev";

    public static function getConfig(): array {
        return [
            self::HOST,
            self::DB_NAME,
            self::USERNAME,
            self::PASSWORD,
        ];
    }
}

