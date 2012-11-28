<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * MainNav View Helper
 *
 * @package     Email Console
 * @subpackage  View_Helpers
 */
class Zend_View_Helper_MainNav extends Zend_View_Helper_Abstract
{
    /**
     * Direct method
     *
     * @return string
     */
    public function mainNav()
    {
        $html = <<<NAV
        <header class="navbar">
            <div class="navbar-inner navbar-static-top">
                <div class="container">
                    <a class="brand" href="/">Email Console</a>
                    <ul class="nav">
                        <li class="active"><a href="/domain">Domains</a></li>
                        <li><a href="#">Administrators</a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Logs</a></li>
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Settings
                                <b class="caret"></b>
                            </a>
                             <ul class="dropdown-menu" role="menu">
                                <li role="menuitem"><a href="#">General</a></li>
                                <li role="menuitem"><a href="#">Amavisd</a></li>
                                <li role="menuitem"><a href="#">SpamAssasin</a></li>
                                <li role="menuitem"><a href="#">SQLGrey</a></li>
                                <li role="menuitem"><a href="#">Policyd</a></li>
                                <li role="menuitem"><a href="#">Templates</a></li>
                                <li role="menuitem"><a href="#">DKIM</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav pull-right">
                        <li><a title="Logout" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

NAV;

        return $html;
    }
}