<?php

/*
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Bootstrap extends \Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Init Default Namespace
     *
     * So we do not have to call our forms prefixed with "Default_".
     * @return \Zend_Application_Module_Autoloader
     */
    public function _initDefaultNamespace()
    {
        $autoloader = new \Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH,
        ));
        return $autoloader;
    }

}
