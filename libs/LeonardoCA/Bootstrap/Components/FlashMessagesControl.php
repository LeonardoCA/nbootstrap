<?php

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 *
 * Copyright (c) 2012 Leonard Odložilík
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap\Components;

use Nette\Utils\Html;

/**
 * Renders Nette Flash Messages as Bootstrap Alerts 
 * 
 * 
 * Usage:
 *
 * - insert in your Base presenter and/or Base Control following code:
 * 
 * 	protected function afterRender()  // to remove old flash message while using ajax and no new flash message is to be displayed
 *	{
 *		if ($this->isAjax()) {
 *			$this->invalidateControl('flashMessages');
 *		}
 *	}
 *
 *	public function createComponentFlashMessages()
 *	{
 *		return new \LeonardoCA\Bootstrap\Components\FlashMessagesControl;
 *	}
 *
 *
 * - insert in your template:
 * 
 * {snippet flashMessages}{control flashMessages}{/snippet}
 * 
 * 
 * - generate Flash Messages using Bootstrap alert classes, but instead of "alert alert-success" just "success"
 * 
 * $this->flashMessage("Page was saved", 'success');
 * 
 * 
 * @author LeonardoCA
 */
class FlashMessagesControl extends \Nette\Application\UI\Control
{
	/**
	 * Render Flash Messages
	 * @param closeIcon bool display close icon default TRUE
	 */
	public function render($closeIcon = TRUE)
	{
		foreach($this->parent->getTemplate()->flashes as $flash) {
			$flashMessage = Html::el('div');
			$flashMessage->class = array("alert", $flash->type ? 'alert-'.$flash->type : NULL);
			$flashMessage->add('<a class="close" data-dismiss="alert" href="#">×</a>');
			$flashMessage->add($flash->message);				
			echo $flashMessage;
		}
	}
}