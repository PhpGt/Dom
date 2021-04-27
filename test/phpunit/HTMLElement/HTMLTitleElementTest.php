<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLTitleElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTitleElementTest extends HTMLElementTestCase {
	public function testText():void {
		/** @var HTMLTitleElement $sut */
		$sut = NodeTestFactory::createHTMLElement("title");
		self::assertSame("", $sut->title);

		for($i = 0; $i < 10; $i++) {
			$t = uniqid();
			$sut->text = $t;
			self::assertSame($t, $sut->innerText);
		}
	}
}
