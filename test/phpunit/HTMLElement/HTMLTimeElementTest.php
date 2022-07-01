<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLDocument;

class HTMLTimeElementTest extends HTMLElementTestCase {
	public function testDateTime():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("time");
		self::assertPropertyAttributeCorrelate($sut, "datetime", "dateTime");
	}
}
