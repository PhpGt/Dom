<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLDocument;

class HTMLBaseElementTest extends HTMLElementTestCase {
	public function testHref():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("base");
		self::assertPropertyAttributeCorrelate($sut, "href");
	}

	public function testTarget():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("base");
		self::assertPropertyAttributeCorrelate($sut, "target");
	}
}
