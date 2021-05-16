<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdc3a5d3212593c5f12186f1d4004d5e0
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\core\\' => 9,
            'app\\controllers\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/core',
        ),
        'app\\controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'app\\core\\App' => __DIR__ . '/../..' . '/app/core/App.php',
        'app\\core\\Controller' => __DIR__ . '/../..' . '/app/core/Controller.php',
        'app\\core\\Request' => __DIR__ . '/../..' . '/app/core/Request.php',
        'app\\core\\Router' => __DIR__ . '/../..' . '/app/core/Router.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdc3a5d3212593c5f12186f1d4004d5e0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdc3a5d3212593c5f12186f1d4004d5e0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdc3a5d3212593c5f12186f1d4004d5e0::$classMap;

        }, null, ClassLoader::class);
    }
}
