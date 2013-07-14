<?php
/**
 * This file is part of Twitter Bootstrap Extension for Nette
 *
 * Copyright (c) 2012 Leonard Odložilík
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap\Components;

use Nette\ComponentModel\IContainer;

/**
 * Extend this class to create your navlist
 *
 * - nesting is not supported yet
 *
 * Example:
 *
 * class SideMenu extends \LeonardoCA\Bootstrap\Components\NavList
 * {
 *     protected function configure(\Nette\ComponentModel\Container $container)
 *     {
 *         $this->addHeader('Administration')
 *         ->addLink('View logs', $container->lazyLink('Admin:logs'))
 *         ->addHeader('Local websites')
 *         ->addLink('Manage local websites', $container->lazyLink('Admin:websitesList'))
 *         ->addLink('Add local website', $container->lazyLink('Admin:websitesDetail'))
 *         ->addDivider()
 *         ->addControl('DomainSwitch');
 *     }
 *
 *     protected function createComponentDomainSwitch()
 *     {
 *         return new DomainSwitch;
 *     }
 * }
 *
 * @author LeonardoCA
 */
class NavList extends \Nette\Application\UI\Control
{
    /**
     * @var array List of navlist items
     */
    private $items;


    /**
     * @var bool Wrap inside div
     */
    private $wrap = true;


    /**
     * @var string Class of wrapper div
     */
    private $wrapperClass = "sidebar-nav well";




    /**
     * Add header
     * @param string $text
     * @return \LeonardoCA\Bootstrap\Components\NavList   provides a fluent interface
     */
    public function addHeader($text)
    {
        $this->items[] = array('type' => 'header', 'text' => $text);
        return $this;
    }



    /**
     * Add single link
     * @param string $title
     * @param \Nette\Application\UI\Link $lazyLink
     * @return \LeonardoCA\Bootstrap\Components\NavList   provides a fluent interface
     */
    public function addLink($title, \Nette\Application\UI\Link $lazyLink)
    {
        $this->items[] = array('type' => 'link', 'title' => $title, 'link' => $lazyLink);
        return $this;
    }



    /**
     * Add horizontal devider
     * @return \LeonardoCA\Bootstrap\Components\NavList   provides a fluent interface
     */
    public function addDivider()
    {
        $this->items[] = array('type' => 'divider');
        return $this;
    }



    /**
     * You can add for example form with select box, etc. But you have to take care of css styles yourself
     * @param string $name
     * @return \LeonardoCA\Bootstrap\Components\NavList   provides a fluent interface
     */
    public function addControl($name)
    {
        $this->items[] = array('type' => 'control', 'name' => lcfirst($name));
        return $this;
    }



    /**
     * List of navigation items
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }



    /**
     * Wrapper class for navigation block
     * @param string $class   Single or multiple classes
     * @return \LeonardoCA\Bootstrap\Components\NavList   provides a fluent interface
     */
    public function setWrapperClass($class)
    {
        $this->wrapperClass = $class;
        return $this;
    }



    /**
     * Should be wrapped?
     * @param bool $wrap
     * @return \LeonardoCA\Bootstrap\Components\NavList   provides a fluent interface
     */
    public function setWrap($wrap)
    {
        $this->wrap = $wrap;
        return $this;
    }



    /**
     * Renders NavList
     * @return void
     */
    public function render()
    {
        $this->template->items = $this->items;
        $this->template->wrap = $this->wrap;
        $this->template->wrapperClass = $this->wrapperClass;
        $this->template->render();
    }



    /**
     * Overwrite this method to configure navigation and add items
     * @param \Nette\ComponentModel\Container $container
     * @return void
     */
    protected function configure(\Nette\ComponentModel\Container $container)
    {
        // intended for adding items in ancestor class
    }



    /**
     * (non-PHPdoc)
     * @see Nette\Application\UI.PresenterComponent::attached()
     */
    protected function attached($container)
    {
        if ($container instanceof \Nette\Application\IPresenter) {
            $this->configure($container);
        }
        parent::attached($container);
    }



	/**
	 * Creates template
	 * @param string|null $class
	 * @return \Nette\Templating\FileTemplate
	 */
	protected function createTemplate($class = null)
	{
		$template = parent::createTemplate($class);
		$template->setFile(dirname(__FILE__) . '/NavList.latte');

		return $template;
	}
}
