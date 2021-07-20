<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLOptGroupElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLOptGroupElementTest extends HTMLElementTestCase {
	public function testDisabled():void {
		/** @var HTMLOptGroupElement $sut */
		$sut = NodeTestFactory::createHTMLElement("optgroup");
		self::assertPropertyAttributeCorrelateBool($sut, "disabled");
	}

	public function testLabel():void {
		/** @var HTMLOptGroupElement $sut */
		$sut = NodeTestFactory::createHTMLElement("optgroup");
		self::assertPropertyAttributeCorrelate($sut, "label");
	}
}
