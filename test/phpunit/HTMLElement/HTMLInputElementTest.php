<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLInputElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLInputElementTest extends HTMLElementTestCase {
	public function testChecked():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateBool($sut, "checked");
	}

	public function testDefaultChecked():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateBool($sut, "checked", "defaultChecked");
	}
}
