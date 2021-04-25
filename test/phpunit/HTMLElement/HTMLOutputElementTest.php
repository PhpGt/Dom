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

	public function testHtmlFor():void {
		/** @var HTMLOutputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("output");
		self::assertCount(0, $sut->htmlFor);
		$sut->htmlFor->add("one", "two", "three");
		self::assertEquals("one two three", $sut->getAttribute("for"));
	}
}
