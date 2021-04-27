<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLTableCellElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTableCellElementTest extends HTMLElementTestCase {
	public function testTd():void {
		$sut = NodeTestFactory::createHTMLElement("td");
		self::assertInstanceOf(HTMLTableCellElement::class, $sut);
	}

	public function testTh():void {
		$sut = NodeTestFactory::createHTMLElement("th");
		self::assertInstanceOf(HTMLTableCellElement::class, $sut);
	}
}
