<?php

/**
 * This file is part of Twitter Bootstrap Extension for Nette
 * Copyright (c) 2012,2013 Leonard Odložilík
 * For the full copyright and license information,
 * please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap;

use Nette;
use Nette\Latte;
use Nette\latte\Compiler;
use Nette\Latte\MacroNode;
use Nette\Latte\PhpWriter;
use Nette\Latte\Engine;
use Nette\Latte\Macros\MacroSet;

/**
 * Bootstrap latte macros
 * <code>
 * {bslabel success}...{/bslabel}
 * {bsbadge success}...{/bsbadge}
 * {bsalert info}...{/bsalert}
 * {bsicon thumbs-up}
 * {bsiconw fire}
 * </code>
 *
 * @author LeonardoCA
 */
class BootstrapMacros extends MacroSet
{

	/**
	 * @param Engine $engine
	 */
	public static function setup(Engine $engine)
	{
		self::install($engine->getCompiler());
	}



	/**
	 * @param Compiler $compiler
	 * @return MacroSet|void
	 */
	public static function install(Compiler $compiler)
	{
		$me = new static($compiler);
		/** @noinspection PhpUnusedParameterInspection */
		$me->addMacro(
			"bslabel",
			array($me, "label"),
			function (MacroNode $node, PhpWriter $writer) {
				return $writer->write('echo "</span>"');
			}
		);
		/** @noinspection PhpUnusedParameterInspection */
		$me->addMacro(
			"bsbadge",
			array($me, "badge"),
			function (MacroNode $node, PhpWriter $writer) {
				return $writer->write('echo "</span>"');
			}
		);
		/** @noinspection PhpUnusedParameterInspection */
		$me->addMacro(
			"bsalert",
			array($me, "alert"),
			function (MacroNode $node, PhpWriter $writer) {
				return $writer->write('echo "</div>"');
			}
		);
		$me->addMacro("bsicon", array($me, "icon"));
		$me->addMacro("bsiconw", array($me, "iconw"));
	}



	public function label(
		/** @noinspection PhpUnusedParameterInspection */
		MacroNode $node, PhpWriter $writer
	) {
		return $writer->write(
			'$_el = Nette\Utils\Html::el("span"); $_el->class = array("label", %node.word ? "label-".%node.word : null); echo $_el->startTag();'
		);
	}



	public function badge(
		/** @noinspection PhpUnusedParameterInspection */
		MacroNode $node, PhpWriter $writer
	) {
		return $writer->write(
			'$_el = Nette\Utils\Html::el("span"); $_el->class = array("badge", %node.word ? "badge-".%node.word : null); echo $_el->startTag();'
		);
	}



	public function alert(
		/** @noinspection PhpUnusedParameterInspection */
		MacroNode $node, PhpWriter $writer
	) {
		return $writer->write(
			'$_el = Nette\Utils\Html::el("div"); $_el->class = array("alert", %node.word ? "alert-".%node.word : null); echo $_el->startTag();'
		);
	}



	public function icon(
		/** @noinspection PhpUnusedParameterInspection */
		MacroNode $node, PhpWriter $writer
	) {
		return $writer->write(
			'$_el = Nette\Utils\Html::el("i"); $_el->class = array(%node.word ? "icon-".%node.word : null); echo $_el;'
		);
	}



	public function iconw(
		/** @noinspection PhpUnusedParameterInspection */
		MacroNode $node, PhpWriter $writer
	) {
		return $writer->write(
			'$_el = Nette\Utils\Html::el("i"); $_el->class = array(%node.word ? "icon-".%node.word : null, "icon-white"); echo $_el;'
		);
	}

}
