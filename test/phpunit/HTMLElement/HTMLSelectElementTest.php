<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLSelectElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLSelectElementTest extends HTMLElementTestCase {
	public function testLengthEmpty():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		self::assertEquals(0, $sut->length);
	}

	public function testLength():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");

		for($i = 0; $i < 10; $i++) {
			$option = $sut->ownerDocument->createElement("option");
			$sut->appendChild($option);
			self::assertEquals($i + 1, $sut->length);
		}
	}
}
