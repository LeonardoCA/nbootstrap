<?php

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 * Copyright (c) 2012,2013 Leonard Odložilík
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap\Components\Navs;

use Nette\ComponentModel\Container;

/**
 * Tab container in NavTabs component
 *
 * @author LeonardoCA
 */
class Tab extends Container
{

	/**
	 * @var string
	 */
	private $label;

	/**
	 * @var string optional direction below|left|right
	 */
	private $type;

	/**
	 * @var string
	 */
	private $controlName;



	public function setControlName($name)
	{
		$this->controlName = lcfirst($name);
		return $this;
	}



	public function getControlName()
	{
		return $this->controlName;
	}



	/**
	 * Set Label
	 *
	 * @param string $label
	 * @return Tab
	 */
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}



	public function getLabel()
	{
		return $this->label;
	}



	/**
	 * Set type
	 *
	 * @param string $type
	 * @return Tab
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}



	public function getType()
	{
		return $this->type;
	}

}
