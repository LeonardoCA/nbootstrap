<?php
/**
 * This file is part of Twitter Bootstrap Extension for Nette
 *
 * Copyright (c) 2012 Leonard Odložilík
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCA\Bootstrap;

use Nette;
use Nette\Latte;

/**
 * @author LeonardoCA
 */
class BootstrapMacros extends Latte\Macros\MacroSet
{
    /**
     * @param \Nette\Latte\Engine $engine
     */
	public static function setup(\Nette\Latte\Engine $engine)
	{
		self::install($engine->getCompiler());
	}



	/**
	 * @param Latte\Compiler $compiler
	 */
	public static function install(Latte\Compiler $compiler)
	{
		$me = new static($compiler);
		$me->addMacro("bslabel",
				array($me, "label"),
				function(Nette\Latte\MacroNode $node, Nette\Latte\PhpWriter $writer) {
					return $writer->write('echo "</span>"');
				}
		);
		$me->addMacro("bsbadge",
				array($me, "badge"),
				function(Nette\Latte\MacroNode $node, Nette\Latte\PhpWriter $writer) {
					return $writer->write('echo "</span>"');
				}
		);
		$me->addMacro("bsalert",
				array($me, "alert"),
				function(Nette\Latte\MacroNode $node, Nette\Latte\PhpWriter $writer) {
					return $writer->write('echo "</div>"');
				}
		);
		$me->addMacro("bsicon", array($me, "icon"));
		$me->addMacro("bsiconw", array($me, "iconw"));
	}



	public function label(Nette\Latte\MacroNode $node, Nette\Latte\PhpWriter $writer)
	{
		return $writer->write('$_el = Nette\Utils\Html::el("span"); $_el->class = array("label", %node.word ? "label-".%node.word : null); echo $_el->startTag();');
	}


	public function badge(Nette\Latte\MacroNode $node, Nette\Latte\PhpWriter $writer)
	{
		return $writer->write('$_el = Nette\Utils\Html::el("span"); $_el->class = array("badge", %node.word ? "badge-".%node.word : null); echo $_el->startTag();');
	}


	public function alert(Nette\Latte\MacroNode $node, Nette\Latte\PhpWriter $writer)
	{
		return $writer->write('$_el = Nette\Utils\Html::el("div"); $_el->class = array("alert", %node.word ? "alert-".%node.word : null); echo $_el->startTag();');
	}


	public function icon(Nette\Latte\MacroNode $node, Nette\Latte\PhpWriter $writer)
	{
		return $writer->write('$_el = Nette\Utils\Html::el("i"); $_el->class = array(%node.word ? "icon-".%node.word : null); echo $_el;');
	}


	public function iconw(Nette\Latte\MacroNode $node, Nette\Latte\PhpWriter $writer)
	{
		return $writer->write('$_el = Nette\Utils\Html::el("i"); $_el->class = array(%node.word ? "icon-".%node.word : null, "icon-white"); echo $_el;');
	}
}
