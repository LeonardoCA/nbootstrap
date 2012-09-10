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
 *         $this->addHeader('Administration');
 *         $this->addLink('View logs', $container->lazyLink('Admin:logs'));
 *         $this->addHeader('Local websites');
 *         $this->addLink('Manage local websites', $container->lazyLink('Admin:websitesList'));
 *         $this->addLink('Add local website', $container->lazyLink('Admin:websitesDetail'));
 *         $this->addDivider();
 *         $this->addControl('DomainSwitch');
 *     }
 *     
 *     protected function createComponentDomainSwitch() {
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
     * @param string $text
     */
    public function addHeader($text)
    {
        $this->items[] = array('type' => 'header', 'text' => $text);
    }
    
    /**
     * @param string $title
     * @param \Nette\Application\UI\Link $lazyLink
     */
    public function addLink($title, \Nette\Application\UI\Link $lazyLink)
    {
        $this->items[] = array('type' => 'link', 'title' => $title, 'link' => $lazyLink);
    }
    
    
    public function addDivider()
    {
        $this->items[] = array('type' => 'divider');
    }
    
    
    /**
     * You can add for example form with select box, etc. But you have to take care of css styles yourself
     * 
     * @param string $name
     */
    public function addControl($name)
    {
        $this->items[] = array('type' => 'control', 'name' => lcfirst($name));
    }
    
    
    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }
    
    
    /**
     * @param string $class
     */
    public function setWrapperClass($class)
    {
        $this->wrapperClass = $class;
    }
    
    
    /**
     * @param bool $wrap
     */
    public function setWrap($wrap)
    {
        $this->wrap = $wrap;
    }
    
    
    public function render()
    {
        $this->template->items = $this->items;
        $this->template->wrap = $this->wrap;
        $this->template->wrapperClass = $this->wrapperClass;
        $this->template->render();
    }

    
    /**
     * @param \Nette\ComponentModel\Container $container
     */
    protected function configure(\Nette\ComponentModel\Container $container)
    {
        // intended for adding items in ancestor class
    }
    
    
    /**
     * @param \Nette\ComponentModel\Container $container
    */
    protected function attached($container)
    {
        if ($container instanceof \Nette\Application\IPresenter)
        {
            $this->configure($container);
        }
        parent::attached($container);
    }
    
	
	/**
	 * @param string|null $class
	 *
	 * @return \Nette\Templating\FileTemplate
	 */
	protected function createTemplate($class = null)
	{
		$template = parent::createTemplate($class);
		$template->setFile(dirname(__FILE__) . '/NavList.latte');
		
		return $template;
	}
}