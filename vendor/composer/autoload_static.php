<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1ea231abc6c446a3850a746f7a690019
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Automattic\\WooCommerce\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Automattic\\WooCommerce\\' => 
        array (
            0 => __DIR__ . '/..' . '/automattic/woocommerce/src/WooCommerce',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1ea231abc6c446a3850a746f7a690019::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1ea231abc6c446a3850a746f7a690019::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1ea231abc6c446a3850a746f7a690019::$classMap;

        }, null, ClassLoader::class);
    }
}