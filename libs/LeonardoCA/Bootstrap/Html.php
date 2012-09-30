<?php
/**
 * This file is part of Twitter Bootstrap Extension for Nette
 *
 * Copyright (c) 2012 Leonard Odložilík
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap;

/**
 * Extends Nette\Utils\Html allowing to generate Bootstrap elements easily
 *
 * @author LeonardoCA
 */
class Html extends \Nette\Utils\Html
{

    /**
     * Bootstrap Icon
     *
     * @param string $icon  Accepts Icon name without 'icon-' preffix
     * @return \LeonardoCA\Bootstrap\Html provides a fluent interface
     */
    public static function bsIcon($icon)
    {
        return self::el('i')->setClass("icon icon-$icon");
    }


    /**
     * Bootstrap Icon white
     *
     * @param string $icon  Accepts Icon name without 'icon-' preffix
     * @return \LeonardoCA\Bootstrap\Html provides a fluent interface
     */
    public static function bsIconw($icon)
    {
        return self::el('i')->setClass("icon icon-$icon icon-white");
    }


    /**
     * Bootstrap Label
     *
     * @param string $label  Accepts Label name without 'label-' preffix
     * @return \LeonardoCA\Bootstrap\Html provides a fluent interface
     */
    public static function bsLabel($message, $label = null)
    {
        return self::el('span')->setClass("label".($label ? " label-$label":''))->setText($message);
    }


    /**
     * Bootstrap Badge
     *
     * @param string $label  Accepts Label name without 'badge-' preffix
     * @return \LeonardoCA\Bootstrap\Html provides a fluent interface
     */
    public static function bsBadge($message, $label)
    {
        return self::el('span')->setClass("badge badge-$label")->setText($message);
    }


    /**
     * Bootstrap Button
     *
     * @param string $el  Hml element used ('a', 'input' or 'button')
     * @param string|\LeonardoCA\Bootstrap\Html $label  Button's label as string or any Html element
     * @param string $class Single or multiple css classes separated by space
     * @param string|\LeonardoCA\Bootstrap\Html $iconBefore  Accepts Icon name without 'icon-' preffix or Icon Html element
     * @param string|\LeonardoCA\Bootstrap\Html $iconAfter  Accepts Icon name without 'icon-' preffix or Icon Html element
     * @return \LeonardoCA\Bootstrap\Html provides a fluent interface
     */
    public static function bsButton(
                    $el,
                    $label,
                    $class = null,
                    $iconBefore = null,
                    $iconAfter = null
    ) {
        $_el = self::el($el);

        if ($iconBefore) {
            if ($iconBefore instanceof Html) {
                $_el->add($iconBefore);
            } else {
                $_el->add(self::bsIcon($iconBefore));
            }
            $_el->add(' ');
        }

        $_el->add($label);

        if ($iconAfter) {
            $_el->add(' ');
            if ($iconAfter instanceof Html) {
                $_el->add($iconAfter);
            } else {
                $_el->add(self::bsIcon($iconAfter));
            }
        }

        $_el->addClass("btn");
        if ($class)
            $_el->addClass($class);

        return $_el;
    }


    /**
     * Bootstrap link formated as button, shortcut fo mini
     *
     * @param string|\LeonardoCA\Bootstrap\Html $label  Button's label as string or any Html element
     * @param string $href
     * @param string $class Single or multiple css classes separated by space
     * @param string|\LeonardoCA\Bootstrap\Html $iconBefore  Accepts Icon name without 'icon-' preffix or Icon Html element
     * @param string|\LeonardoCA\Bootstrap\Html $iconAfter  Accepts Icon name without 'icon-' preffix or Icon Html element
     * @return \LeonardoCA\Bootstrap\Html provides a fluent interface
     */
    public static function bsLinkMini($label, $href, $class = null, $iconBefore = null, $iconAfter = null)
    {
        $_el = self::bsButton('a', $label, 'btn btn-mini'.($class ? ' btn-'.$class : ''), $iconBefore, $iconAfter);
        $_el->setHref($href);
        return $_el;
    }



    /**
     * Add drop down menu to html element
     *
     * General dropdown code
     * <code>
     * <div class="dropdown">
     *     <!-- Link or button to toggle dropdown -->
     *     <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
     *         <li><a tabindex="-1" href="#">Action</a></li>
     *         <li><a tabindex="-1" href="#">Another action</a></li>
     *         <li><a tabindex="-1" href="#">Something else here</a></li>
     *         <li class="divider"></li>
     *         <li><a tabindex="-1" href="#">Separated link</a></li>
     *     </ul>
     *</div>
     *</code>
     *
     * @param \LeonardoCA\Bootstrap\Html   DropdownMenu
     * @return \LeonardoCA\Bootstrap\Html   Newly created element with dropdown
     */
    final public function addDropDown(\LeonardoCA\Bootstrap\Html $dropdownMenu)
    {
        $container = self::el('div', array('class' => 'dropdown'));
        $this->addAttributes(array('data-toggle' => 'dropdown'));
        $this->class[]='dropdown-toggle';
        $this->add(' <span class="caret"></span>');
        $container
        ->add($this)
        ->add($dropdownMenu);
        return $container;
    }



    /**
     * Creates DropdownMenu - call addMenuItem and addDevider to define menu items
     * Call addDropDown on element you wish to add dropdown using element returned from this function
     * @return \LeonardoCA\Bootstrap\Html
     */
    public static function bsDropdownMenu()
    {
        $el = self::el('ul', array('class' => 'dropdown-menu', 'role' => 'menu'));
        return $el;
    }



    /**
     * Adds new menu item to dropdowns
     * @param  Html|string link text + icon
     * @param  Href Link or LazyLink
     * @return \LeonardoCA\Bootstrap\Html  provides a fluent interface
     */
    final public function addMenuItem($htmlText, $href = '#', $ajax = false, $submenu = null)
    {
        $anchor = self::el('a')->addAttributes(array('tabindex' => '-1'));
        $anchor->setHtml($htmlText)->setHref($href);
        if ($ajax) {
            $anchor->class[] = 'ajax';
        }
        $child = self::el('li')->add($anchor);
        if ($submenu != null) {
            $child->add($submenu);
        }
        return $this->add($child);
    }



    /**
     * Adds new devider to dropdowns
     * @return \LeonardoCA\Bootstrap\Html  provides a fluent interface
     */
    final public function addDevider()
    {
        $child = self::el('li', array('class' => 'divider'));
        return $this->add($child);
    }
}
