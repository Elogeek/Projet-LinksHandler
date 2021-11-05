<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6c77c93c6179ca37496199c3d441c9bf
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Muffeen\\UrlStatus\\' => 18,
        ),
        'E' => 
        array (
            'Elogeek\\LinksHandler\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Muffeen\\UrlStatus\\' => 
        array (
            0 => __DIR__ . '/..' . '/muffeen/url-status/src',
        ),
        'Elogeek\\LinksHandler\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6c77c93c6179ca37496199c3d441c9bf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6c77c93c6179ca37496199c3d441c9bf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6c77c93c6179ca37496199c3d441c9bf::$classMap;

        }, null, ClassLoader::class);
    }
}