<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit47e30791e3264828061d6614459c2c78
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit47e30791e3264828061d6614459c2c78::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}