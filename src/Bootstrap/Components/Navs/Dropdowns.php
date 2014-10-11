<?php

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 * Copyright (c) 2012,2013 Leonard Odložilík
 * For the full copyright and license information,
 * please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap\Components\Navs;

use Nette\ComponentModel\Container;

/**
 * Creates Dropdown
 *
 * @author LeonardoCA
 */
class DropDown extends Container
{

	/**
	 * @var string
	 */
	private $active;



	public function getActive()
	{
		return $this->active;
	}



	/**
	 * @param string $name  Pill name - will be used as id
	 * @param string $label Pill Label
	 * @param string $type  Default "block"
	 * @return DropDown
	 */
	public function addPill($name, $label = null, $type = "control")
	{
		$tab = new Tab;
		$tab
			->setLabel($label ? $label : $name)
			->setControlName($name)
			->setType($type);
		$this->addComponent($tab, 'tab' . (++$this->tabsNumber));
		return $this;
	}

}
