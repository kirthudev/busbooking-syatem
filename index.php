<?php
 ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
session_start();
/*
 * API Request handler.
 */

// Define constant for ROOT_DIR
define('ROOT_DIR', dirname(__FILE__));

require_once ROOT_DIR . '/Config/Configuration.php';

// auto load the class files
spl_autoload_register(function ($fileName) {
    
    $NSSplit  = explode('\\', $fileName);
    unset($NSSplit[0]);
    $filePath = ROOT_DIR . '/' . implode('/', $NSSplit) . '.class.php';

    if (!file_exists($filePath)) {
        $filePath = ROOT_DIR . '/' . implode('/', $NSSplit) . '.php';
    } else {
        require_once $filePath;
        return true;
    }
        
    if (file_exists($filePath)) {
        require_once $filePath;
        return true;
    }
    return false;
});

require_once ROOT_DIR . '/Lib/HTML/Template/Sigma.php';

$request = new bookingsystem\Controller\RequestController();
$request->processRequest();