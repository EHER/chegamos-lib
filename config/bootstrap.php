<?php 

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors','On');

$pear_path = trim(`pear config-get php_dir`);
set_include_path('src' 
        . PATH_SEPARATOR . 'vendor'
        . PATH_SEPARATOR . $pear_path 
        . PATH_SEPARATOR . get_include_path());

/**
 * Autoloader that implements the PSR-0 spec for interoperability between
 * PHP software.
 */
spl_autoload_register(
    function($className) {
        $fileParts = explode('\\', ltrim($className, '\\'));

        if (false !== strpos(end($fileParts), '_')) {
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));
        }

        $file = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';

        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            $path = $path . DIRECTORY_SEPARATOR . $file;
            if (file_exists($path)) {
                $success = require($path);
                return $success;
            }
        }
    }
);
