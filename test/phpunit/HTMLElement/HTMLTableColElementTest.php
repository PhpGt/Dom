<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLTableColElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTableColElementTest extends HTMLElementTestCase {
	public function testSpan():void {
		/** @var HTMLTableColElement $sut */
		$sut = NodeTestFactory::createHTMLElement("col");
		self::assertPropertyAttributeCorrelateNumber($sut, "int:1", "span");
	}
}
