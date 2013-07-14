<?php

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 * Copyright (c) 2012,2013 Leonard Odložilík
 * For the full copyright and license information,
 * please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap\Components;

use Nette\Utils\Html;
use Nette\Application\UI\Control;

/**
 * Renders Nette Flash Messages as Bootstrap Alerts
 *
 * Usage:
 * - insert in your Base presenter and/or Base Control following code:
 * <code>
 * protected function afterRender()  // to remove previous flash message if using ajax and no new flash message should be displayed
 * {
 *      if ($this->isAjax()) {
 *        $this->invalidateControl('flashMessages');
 *    }
 * }
 * public function createComponentFlashMessages()
 * {
 *        return new \LeonardoCA\Bootstrap\Components\FlashMessagesControl;
 * }
 * </code>
 * - insert in your template:
 * <code>
 * {snippet flashMessages}{control flashMessages}{/snippet}
 * </code>
 * - generate Flash Messages using Bootstrap alert classes, but instead of "alert alert-success" just "success"
 * <code>
 * $this->flashMessage("Page was saved", 'success');
 * </code>
 *
 * @author LeonardoCA
 */
class FlashMessagesControl extends Control
{

	/**
	 * Render Flash Messages
	 *
	 * @param bool $closeIcon
	 * @return void
	 * @internal param bool $closeIcon Display close icon - default true
	 */
	public function render($closeIcon = true)
	{
		/** @noinspection PhpUndefinedMethodInspection */
		foreach ($this->parent->getTemplate()->flashes as $flash) {
			$flashMessage = Html::el('div');
			$flashMessage->class = array("alert", $flash->type ? 'alert-' . $flash->type : null);
			if ($closeIcon) {
				$flashMessage->add('<a class="close" data-dismiss="alert" href="#">×</a>');
			}
			$flashMessage->add($flash->message);
			echo $flashMessage;
		}
	}

}
