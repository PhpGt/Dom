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

	public function testStart():void {
		/** @var HTMLOListElement $sut */
		$sut = NodeTestFactory::createHTMLElement("ol");
		self::assertSame(1, $sut->start);
		self::assertPropertyAttributeCorrelateNumber($sut, "int:1",  "start");
	}
}
