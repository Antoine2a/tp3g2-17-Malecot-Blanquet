<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4fbbdcfa0c01582523b5dde1f26885cf
{
    public static $classMap = array (
        'Feed' => __DIR__ . '/..' . '/dg/rss-php/src/Feed.php',
        'FeedException' => __DIR__ . '/..' . '/dg/rss-php/src/Feed.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit4fbbdcfa0c01582523b5dde1f26885cf::$classMap;

        }, null, ClassLoader::class);
    }
}
