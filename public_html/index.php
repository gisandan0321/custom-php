<?php

$host = $_SERVER['HTTP_HOST'];

/*
 * ENVIRONMENT
 */
switch ($host) {
    case 'localhost':
    case 'custom.dev':
        define('ENVIRONMENT', 'development');
        break;
    case 'beta.custom.com':
        define('ENVIRONMENT', 'staging');
        break;
    case 'custom.com':
        define('ENVIRONMENT', 'production');
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'Service is unavailable this time. Please try again later.';
        exit(1); // EXIT_ERROR
}

/*
 * ERROR Reporting
 */
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    case 'staging':
    case 'production':
        ini_set('display_errors', 0);

        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;
    default: 
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'Service is unavailable this time. Please try again later.';
        exit(1); // EXIT_ERROR
}


define('SYSTEM', '../system');
define('APPLICATION', '../application');
define('PUBLIC_HTML', '../public_html');

define('PHP_EXT', '.php');

require APPLICATION . '/vendor/autoload.php';

require SYSTEM . '/core/Route.php';
