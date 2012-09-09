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
 * Example:
 * - used to generate alert message
 * 
 *                        $alerts->add(
 *                                        "Page id: ".\LeonardoCA\Bootstrap\Html::bsLabel($id, 'info')." was "
 *                                        .\LeonardoCA\Bootstrap\Html::bsLabel('deleted!', 'important')." You may "
 *                                        .\LeonardoCA\Bootstrap\Html::bsLinkMini('undelete it', $this->link('undelete!', array('id' => $id)), 'primary'), 'info'
 *                        );
 * 
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
	public static function bsLabel($message, $label)
	{
	    return self::el('span')->setClass("label label-$label")->setText($message);
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
	public static function bsButton($el, $label, $class = NULL, $iconBefore = NULL, $iconAfter = NULL)
	{
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
	public static function bsLinkMini($label, $href, $class = NULL, $iconBefore = NULL, $iconAfter = NULL)
	{
	    $_el = self::bsButton('a', $label, 'btn btn-mini'.($class ? ' btn-'.$class : ''), $iconBefore, $iconAfter);
	    $_el->setHref($href);
	    return $_el;
	}
}