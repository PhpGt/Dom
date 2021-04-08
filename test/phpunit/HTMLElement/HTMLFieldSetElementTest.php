<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLFieldSetElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLFieldSetElementTest extends HTMLElementTestCase {
	public function testDisabled():void {
		/** @var HTMLFieldSetElement $sut */
		$sut = NodeTestFactory::createHTMLElement("fieldset");
		self::assertPropertyAttributeCorrelateBool($sut, "disabled");
	}
}
