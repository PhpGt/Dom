<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLDataElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLDataElementTest extends HTMLElementTestCase {
	public function testValueNone():void {
		/** @var HTMLDataElement $sut */
		$sut = NodeTestFactory::createHTMLElement("data");
		self::assertSame("", $sut->value);
	}

	public function testValue():void {
		/** @var HTMLDataElement $sut */
		$sut = NodeTestFactory::createHTMLElement("data");
		$sut->value = "test value";
		self::assertEquals("test value", $sut->value);
		self::assertEquals("test value", $sut->getAttribute("value"));
	}
}
