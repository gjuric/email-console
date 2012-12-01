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
 * Menu View Helper
 *
 * @package     Email Console
 * @subpackage  View_Helpers
 */
class Zend_View_Helper_Menu extends Zend_View_Helper_Abstract
{
    /**
     * Navigation object
     *
     * @var Zend_Navigation
     */
    private $navigation;

    /**
     * Contructor
     */
    public function __construct()
    {
        $navigation = new Zend_Navigation(new Zend_Config_Ini(
            APPLICATION_PATH . '/configs/navigation.ini', 'main-menu'));
        $this->navigation = $navigation;
    }

    /**
     * Render Menu
     *
     * @return string
     */
    public function menu()
    {
        $html = array();
        $html[] = '                    <ul class="nav">';
        foreach ($this->navigation as $page) {
            $class = ($page->isActive(true)) ? 'active' : '';

            if ($page->hasChildren()) {
                $html[] = "                        <li class=\"dropdown {$class}\">";
                $html[] .= '                            <a href="' . $page->getHref() . '"  class="dropdown-toggle" data-toggle="dropdown">' . $page->getLabel() . ' <b class="caret"></b></a>';
                $html[] .= $this->renderSubMenu($page);
                $html[] .= "                        </li>";
            } else {
                $html[] = "                        <li class=\"{$class}\">" . '<a href="' . $page->getHref() . '">' . $page->getLabel() . "</a></li>";
            }
        }
        $html[] = "                    </ul>" . PHP_EOL;
        return join(PHP_EOL, $html);
    }

    /**
     * Render Sub Menu
     *
     * @param Zend_Navigation_Page $page
     * @return strings
     */
    private function renderSubMenu(\Zend_Navigation_Page $page)
    {
        $html = array();
        $html[] = '                            <ul class="dropdown-menu" role="menu">';
        $pages = $page->getPages();
        foreach ($pages as $page) {
            $html[] = '                                <li role="menuitem"><a href="' . $page->getHref() . '">' . $page->getLabel() . '</a></li>';
        }
        $html[] = "                            </ul>";
        return join(PHP_EOL, $html);
    }
}
