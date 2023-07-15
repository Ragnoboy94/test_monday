<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2097b5252edf0bf0a73d0cee576c2729
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit2097b5252edf0bf0a73d0cee576c2729', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2097b5252edf0bf0a73d0cee576c2729', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit2097b5252edf0bf0a73d0cee576c2729::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
