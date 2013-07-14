<?php

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 * Copyright (c) 2012,2013 Leonard Odložilík
 * For the full copyright and license information,
 * please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap;

use Nette\Application\UI\Link;

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
	 * @param string $icon   Accepts Icon name without 'icon-' prefix
	 * @return Html    provides a fluent interface
	 */
	public static function bsIcon($icon)
	{
		return static::el('i')->setClass("icon icon-$icon");
	}



	/**
	 * Bootstrap Icon white
	 *
	 * @param string $icon   Accepts Icon name without 'icon-' prefix
	 * @return Html    provides a fluent interface
	 */
	public static function bsIconw($icon)
	{
		return static::el('i')->setClass("icon icon-$icon icon-white");
	}



	/**
	 * Bootstrap Label
	 *
	 * @param string $text
	 * @param string $label Accepts Label name without 'label-' prefix
	 * @return Html    provides a fluent interface
	 */
	public static function bsLabel($text, $label = null)
	{
		return static::el('span')
			->setClass("label" . ($label ? " label-$label" : ''))
			->setText($text);
	}



	/**
	 * Bootstrap Badge
	 *
	 * @param string $text
	 * @param string $badge Accepts Badge name without 'badge-' prefix
	 * @return Html    provides a fluent interface
	 */
	public static function bsBadge($text, $badge = null)
	{
		return static::el('span')
			->setClass("badge" . ($badge ? " badge-$badge" : ''))
			->setText($text);
	}



	/**
	 * Bootstrap Button
	 *
	 * @param string      $el             Html element used ('a', 'input' or 'button')
	 * @param string|Html $label          label as string or any Html element
	 * @param string      $class          single or multiple css classes separated by space
	 * @param string|Html $iconBefore     Icon name without 'icon-' prefix or Icon Html element
	 * @param string|Html $iconAfter      Icon name without 'icon-' prefix or Icon Html element
	 * @return Html    provides a fluent interface
	 */
	public static function bsButton(
		$el,
		$label,
		$class = null,
		$iconBefore = null,
		$iconAfter = null
	) {
		$_el = static::el($el);
		if ($iconBefore) {
			if ($iconBefore instanceof Html) {
				$_el->add($iconBefore);
			} else {
				$_el->add(static::bsIcon($iconBefore));
			}
			$_el->add(' ');
		}
		$_el->add($label);
		if ($iconAfter) {
			$_el->add(' ');
			if ($iconAfter instanceof Html) {
				$_el->add($iconAfter);
			} else {
				$_el->add(static::bsIcon($iconAfter));
			}
		}
		$_el->addClass("btn");
		if ($class) {
			$_el->addClass($class);
		}
		return $_el;
	}



	/**
	 * Bootstrap link formatted as button, shortcut fo mini
	 *
	 * @param string|Html $label         label as string or any Html element
	 * @param string      $href
	 * @param string      $class         single or multiple css classes separated by space
	 * @param string|Html $iconBefore    Icon name without 'icon-' prefix or Icon Html element
	 * @param string|Html $iconAfter     Icon name without 'icon-' prefix or Icon Html element
	 * @return Html  provides a fluent interface
	 */
	public static function bsLinkMini(
		$label,
		$href,
		$class = null,
		$iconBefore = null,
		$iconAfter = null
	) {
		$_el = static::bsButton(
			'a',
			$label,
			'btn btn-mini' . ($class ? ' btn-' . $class : ''),
			$iconBefore,
			$iconAfter
		);
		$_el->setHref($href);
		return $_el;
	}



	/**
	 * Add pull-right class to right align or float right
	 *
	 * @return Html    provides a fluent interface
	 */
	final public function bsPullRight()
	{
		return $this->addClass('pull-right');
	}



	/**
	 * Add drop down menu to html element
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
	 * @param Html $dropdownMenu
	 * @return Html   Newly created element with dropdown
	 */
	final public function addDropDown(Html $dropdownMenu)
	{
		$this->data('toggle', 'dropdown')
			->addClass('dropdown-toggle')
			->add(' <span class="caret"></span>');
		$container = static::el('div');
		$container
			->addClass('btn-group')
			->add($this)
			->add($dropdownMenu);
		return $container;
	}



	/**
	 * Creates DropdownMenu - call addMenuItem and addDivider to define menu items
	 * Call addDropDown on element you wish to add dropdown using element returned from this function
	 *
	 * @return Html    provides a fluent interface
	 */
	public static function bsDropdownMenu()
	{
		return static::el('ul', array('class' => 'dropdown-menu', 'role' => 'menu'));
	}



	/**
	 * Adds new menu item to drop downs
	 *
	 * @param  string      $htmlText    text + icon
	 * @param  string|Link $href        Link or LazyLink
	 * @param  bool        $ajax        Add ajax class? (ajax link when using nette.ajax.js)
	 * @param  null|Html   $subMenu     Add subMenu
	 * @return Html    provides a fluent interface
	 */
	final public function addMenuItem($htmlText, $href = '#', $ajax = false, $subMenu = null)
	{
		/** @var $anchor Html */
		$anchor = static::el('a')
			->tabindex('-1')
			->setHtml($htmlText)
			->setHref($href);
		if ($ajax) {
			$anchor->addClass('ajax');
		}
		$child = static::el('li')
			->add($anchor);
		if ($subMenu != null) {
			$child->addClass('dropdown-submenu');
			$child->add($subMenu);
		}
		return $this->add($child);
	}



	/**
	 * Adds new divider to drop downs
	 *
	 * @return Html  provides a fluent interface
	 */
	final public function addDivider()
	{
		$child = static::el('li', array('class' => 'divider'));
		return $this->add($child);
	}

}
