<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLDocument;

class HTMLLiElementTest extends HTMLElementTestCase {
	public function testValue():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("li");
		self::assertPropertyAttributeCorrelateNumber($sut, "int", "value");
	}
}
