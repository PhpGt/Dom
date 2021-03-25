<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLButtonElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLButtonElementTest extends HTMLElementTestCase {
	public function testAutofocus():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		self::assertPropertyAttributeCorrelateBool($sut, "autofocus");
	}
}
