<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLOListElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLOListElementTest extends HTMLElementTestCase {
	public function testReversed():void {
		/** @var HTMLOListElement $sut */
		$sut = NodeTestFactory::createHTMLElement("ol");
		self::assertPropertyAttributeCorrelateBool($sut, "reversed");
	}
}
