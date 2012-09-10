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
 * Works similar to Flash Messages, but renders alerts in current page, not after redirect
 * 
 * @author LeonardoCA
 */
class Alerts extends \Nette\Application\UI\Control
{
    /** @var array */
	private $presenter;
	
	/** @var array */
	private $alerts;
	
	
	/**
	 * @param string $message Your message, it may be even html element which will not be escaped while rendering
	 * @param string $type Bootstrap alert class, but instead of "alert alert-success" use just "success"
	 * @param bool $dismiss display close icon default false
	 */
	public function add($message, $type = null, $dismiss = false)
	{
	    $this->alerts[] = array('message' => $message, 'type' => $type, 'dismiss' => $dismiss);
	}
	
	
	public function get()
	{
	    return $this->alerts;
	}
	

	public function clear()
	{
	    unset($this->alerts);
	}


	/**
	 * @param \Nette\ComponentModel\Container $obj
	 */
	protected function attached($obj)
	{
		if ($obj instanceof \Nette\Application\IPresenter) {
			$this->presenter = $this->getPresenter();
		}
		parent::attached($obj);
	}
	
	
	/**
	 * @param string|null $class
	 *
	 * @return \Nette\Templating\FileTemplate
	 */
	protected function createTemplate($class = null)
	{
		$template = parent::createTemplate($class);
		$class = $this->getReflection();
	
		$file = dirname($class->getFileName()) . '/' . $class->getShortName() . '.latte';
		$template->setFile($file);
	
		return $template;
	}
	
	
	public function render()
	{
		$this->template->alerts = $this->alerts;
		$this->template->render();
	}
}