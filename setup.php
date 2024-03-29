<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Application constants
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(dirname(__FILE__)));
}
if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', ROOT_PATH . '/application');
}
if (!defined('LIBRARY_PATH')) {
    define('LIBRARY_PATH', ROOT_PATH . '/library');
}

// Set environmnet (default to 'production')
if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV',
        (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production')
    );
}

// Add LIBRARY_PATH at the beginning of the include path
set_include_path(LIBRARY_PATH . PATH_SEPARATOR . get_include_path());

// Zend_Application
require_once LIBRARY_PATH . '/Zend/Application.php';

// Use application.local.ini if exists
if (file_exists(APPLICATION_PATH . '/configs/application.local.ini')) {
    $appIni = APPLICATION_PATH . '/configs/application.local.ini';
} else {
    $appIni = APPLICATION_PATH . '/configs/application.ini';
}

// Create application
$application = new Zend_Application(APPLICATION_ENV, $appIni);