<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit232a0794228c857759dc1bbe69463199
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'thebigcrafter\\OhMyPMMP\\' => 23,
        ),
        'R' => 
        array (
            'React\\Promise\\' => 14,
        ),
        'C' => 
        array (
            'CortexPE\\Commando\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'thebigcrafter\\OhMyPMMP\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/thebigcrafter/OhMyPMMP',
        ),
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'CortexPE\\Commando\\' => 
        array (
            0 => __DIR__ . '/..' . '/cortexpe/commando/src/CortexPE/Commando',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit232a0794228c857759dc1bbe69463199::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit232a0794228c857759dc1bbe69463199::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit232a0794228c857759dc1bbe69463199::$classMap;

        }, null, ClassLoader::class);
    }
}
