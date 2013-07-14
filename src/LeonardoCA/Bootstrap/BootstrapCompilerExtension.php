<?php 

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 *
 * Copyright (c) 2012 Leonard Odložilík
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap;

use Nette\Config;

/**
 * Registering Bootstrap Macros with Latte filter
 * 
 * include in your bootstrap.php or do it however you want
 * 
 * $configurator->onCompile[] = function ($configurator, $compiler) {
 *    $compiler->addExtension('bootstrap', new LeonardoCA\Bootstrap\BootstrapCompilerExtension);
 * };
 * 
 * @author LeonardoCA
 */
class BootstrapCompilerExtension extends \Nette\Config\CompilerExtension
{
	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		if ($builder->hasDefinition('nette.latte')) {
			$builder->getDefinition('nette.latte')->addSetup('LeonardoCA\Bootstrap\BootstrapMacros::setup', array('@self'));
		}
	}
}