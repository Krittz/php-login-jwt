<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1354af19b12138e76e0a00b469ee4a2b
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
            1 => __DIR__ . '/..' . '/norbertjurga/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1354af19b12138e76e0a00b469ee4a2b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1354af19b12138e76e0a00b469ee4a2b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1354af19b12138e76e0a00b469ee4a2b::$classMap;

        }, null, ClassLoader::class);
    }
}
