<?php

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 * Copyright (c) 2012,2013 Leonard Odložilík
 * For the full copyright and license information,
 * please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap\DI;

use Nette\Configurator;
use Nette\DI\Compiler;
use Nette\DI\CompilerExtension;

/**
 * Registers Bootstrap Macros with Latte filter
 *
 * @author LeonardoCA
 */
class BootstrapExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		if ($builder->hasDefinition('nette.latte')) {
			$builder->getDefinition('nette.latte')
				->addSetup('\LeonardoCA\Bootstrap\BootstrapMacros::setup', array('@self'));
		}
	}



	public static function register(Configurator $configurator)
	{
		/** @noinspection PhpUnusedParameterInspection */
		$configurator->onCompile[] = function (Configurator $configurator, Compiler $compiler) {
			$compiler->addExtension('bootstrap', new BootstrapExtension);
		};
	}

}
