<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b309115ba4ce2b478d884a1dec0d754
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MagicClass\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MagicClass\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/models',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b309115ba4ce2b478d884a1dec0d754::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b309115ba4ce2b478d884a1dec0d754::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit2b309115ba4ce2b478d884a1dec0d754::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit2b309115ba4ce2b478d884a1dec0d754::$classMap;

        }, null, ClassLoader::class);
    }
}