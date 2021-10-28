<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit51e429f84028471c0ce50ca7c28581cb
{
    public static $files = array (
        '5f2aad0f1beee097fba38a252c1ebd00' => __DIR__ . '/..' . '/a7/autoload/package.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Predis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit51e429f84028471c0ce50ca7c28581cb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit51e429f84028471c0ce50ca7c28581cb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit51e429f84028471c0ce50ca7c28581cb::$classMap;

        }, null, ClassLoader::class);
    }
}
