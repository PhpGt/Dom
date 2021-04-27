<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLStyleElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLStyleElementTest extends HTMLElementTestCase {
	public function testMedia():void {
		/** @var HTMLStyleElement $sut */
		$sut = NodeTestFactory::createHTMLElement("style");
		self::assertPropertyAttributeCorrelate($sut, "media");
	}
}
