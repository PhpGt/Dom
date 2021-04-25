<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLOutputElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLOutputElementTest extends HTMLElementTestCase {
	public function testDefaultValue():void {
		/** @var HTMLOutputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("output");
		self::assertPropertyAttributeCorrelate($sut, "value", "defaultValue");
	}
}
