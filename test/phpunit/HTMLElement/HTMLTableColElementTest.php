<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLDocument;

class HTMLTableColElementTest extends HTMLElementTestCase {
	public function testSpan():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("col");
		self::assertPropertyAttributeCorrelateNumber($sut, "int:1", "span");
	}
}
