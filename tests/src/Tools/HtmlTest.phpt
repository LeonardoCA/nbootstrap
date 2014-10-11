<?php

/**
 * This file is part of LeonardoCA\Tools for Nette Framework
 * Copyright (c) 2012 Leonard Odložilík
 * For the full copyright and license information,
 * please view the file license.txt that was distributed with this source code.
 */

namespace LeonardoCATests\Bootstrap;

use LeonardoCA\Bootstrap\Html;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * @author Leonard Odložilík
 */
class HtmlTest extends \Tester\TestCase
{

	public function testAlert()
	{
		Assert::same(
			'<span class="label label-important">deleted</span>',
			(string)Html::bsLabel('deleted', 'important')
		);
	}

}

$testCache = new HtmlTest;
$testCache->run();
