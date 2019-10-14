<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2c2cff8eebe4743f701d42a580392407
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2c2cff8eebe4743f701d42a580392407::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2c2cff8eebe4743f701d42a580392407::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}