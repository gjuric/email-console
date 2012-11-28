<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once realpath(dirname(__FILE__) . '/../setup.php');

// Create application
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()->run();
