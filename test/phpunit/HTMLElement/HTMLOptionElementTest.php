<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLOptionElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLOptionElementTest extends HTMLElementTestCase {
	public function testDefaultSelected():void {
		/** @var HTMLOptionElement $sut */
		$sut = NodeTestFactory::createHTMLElement("option");
		self::assertPropertyAttributeCorrelateBool($sut, "selected", "defaultSelected");
	}

	public function testDisabled():void {
		/** @var HTMLOptionElement $sut */
		$sut = NodeTestFactory::createHTMLElement("option");
		self::assertPropertyAttributeCorrelateBool($sut, "disabled");
	}
}
