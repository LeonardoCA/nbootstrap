<?php

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 * Copyright (c) 2012,2013 Leonard Odložilík
 * For the full copyright and license information,
 * please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap\Components\Navs;

use Nette\ComponentModel\Container;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Control;
use Nette\Templating\FileTemplate;

/**
 * Extend this class to create your navlist
 * Example:
 * class SideMenu extends \LeonardoCA\Bootstrap\Components\Navs\NavTabs
 * {
 *     protected function configure(\Nette\ComponentModel\Container $container)
 *     {
 *         $this->addTab('Logs');
 *         $this->addTab('ErrorLogs');
 *     }
 *     protected function createComponentDataTable() {
 *         return new DataTable;
 *     }
 * }
 *
 * @author LeonardoCA
 */
class NavTabs extends Control
{

	/**
	 * @var string optional direction below|left|right
	 */
	private $direction;

	/**
	 * @var string
	 */
	private $active;

	/**
	 * @var int
	 */
	private $tabsNumber = 0;



	/**
	 * @param string $direction
	 * @return NavTabs
	 */
	public function setDirection($direction)
	{
		$this->direction = $direction;
		return $this;
	}



	public function getDirection()
	{
		return $this->direction;
	}



	/**
	 * @param $active
	 * @return NavTabs
	 */
	public function setActive($active)
	{
		$this->active = $active;
		return $this;
	}



	public function getActive()
	{
		return $this->active;
	}



	/**
	 * @param string $name  Tab name - will be used as id
	 * @param string $label Tab Label
	 * @param string $type  Default "block"
	 * @return NavTabs
	 */
	public function addTab($name, $label = null, $type = "control")
	{
		$tab = new Tab;
		$tab->setLabel($label ? $label : $name)
			->setControlName($name)
			->setType($type);
		$this->addComponent($tab, 'tab' . (++$this->tabsNumber));
		return $this;
	}



	public function render()
	{
		/** @var $this->template Template */
		$this->template->direction = $this->direction;
		$this->template->render();
	}



	/**
	 * @param Container $container
	 */
	protected function configure(Container $container)
	{
	}



	/**
	 * @param \Nette\ComponentModel\Container $container
	 */
	protected function attached($container)
	{
		if ($container instanceof Presenter) {
			$this->configure($container);
			foreach ($this->getComponents() as $component) {
				$this->active = $component->name;
				break;
			}
		}
		parent::attached($container);
	}



	/**
	 * @param string|null $class
	 * @return \Nette\Templating\FileTemplate
	 */
	protected function createTemplate($class = null)
	{
		/** @var FileTemplate $template */
		$template = parent::createTemplate($class);
		$template->setFile(dirname(__FILE__) . '/NavTabs.latte');
		return $template;
	}

}
