<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita726b8a8333e9aafb6c329d04ba30490
{
    public static $files = array (
        'af089f0efd53176fee3a8526297ff096' => __DIR__ . '/../..' . '/routes/web.php',
        'e9cc8a499036a35028f118323bf89b5f' => __DIR__ . '/../..' . '/start/common.php',
        '141f9adadf26ef22f24358b22c2b7ec2' => __DIR__ . '/../..' . '/start/helpers/array.php',
        '18c7be9fd2982e4d53c27ba03c154f7d' => __DIR__ . '/../..' . '/start/helpers/string.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'start\\' => 6,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'start\\' => 
        array (
            0 => __DIR__ . '/../..' . '/start',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'start\\core\\App' => __DIR__ . '/../..' . '/start/core/App.php',
        'start\\core\\Config' => __DIR__ . '/../..' . '/start/core/Config.php',
        'start\\core\\Helper' => __DIR__ . '/../..' . '/start/core/Helper.php',
        'start\\core\\Request' => __DIR__ . '/../..' . '/start/core/Request.php',
        'start\\core\\Route' => __DIR__ . '/../..' . '/start/core/Route.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita726b8a8333e9aafb6c329d04ba30490::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita726b8a8333e9aafb6c329d04ba30490::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita726b8a8333e9aafb6c329d04ba30490::$classMap;

        }, null, ClassLoader::class);
    }
}
