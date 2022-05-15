<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLTableCellElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTableCellElementTest extends HTMLElementTestCase {
//	public function testTd():void {
//		$sut = NodeTestFactory::createHTMLElement("td");
//		self::assertInstanceOf(HTMLTableCellElement::class, $sut);
//	}
//
//	public function testTh():void {
//		$sut = NodeTestFactory::createHTMLElement("th");
//		self::assertInstanceOf(HTMLTableCellElement::class, $sut);
//	}
//
//	public function testAbbr():void {
//		/** @var HTMLTableCellElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("th");
//		self::assertPropertyAttributeCorrelate($sut, "abbr");
//	}
//
//	public function testGetCellIndexNoTr():void {
//		/** @var HTMLTableCellElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("th");
//		self::assertSame(-1, $sut->cellIndex);
//	}
//
//	public function testGetCellIndexFirst():void {
//		/** @var HTMLTableCellElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("th");
//		$tr = $sut->ownerDocument->createElement("tr");
//		$tr->appendChild($sut);
//		self::assertSame(0, $sut->cellIndex);
//	}
//
//	public function testGetCellIndex():void {
//		/** @var HTMLTableCellElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("td");
//		$tr = $sut->ownerDocument->createElement("tr");
//
//		for($i = 0; $i < 10; $i++) {
//			$tr->appendChild($sut->ownerDocument->createElement("td"));
//		}
//
//		$tr->appendChild($sut);
//
//		for($i = 0; $i < 10; $i++) {
//			$tr->appendChild($sut->ownerDocument->createElement("td"));
//		}
//
//		self::assertSame(10, $sut->cellIndex);
//	}
//
//	public function testColSpan():void {
//		/** @var HTMLTableCellElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("td");
//		self::assertPropertyAttributeCorrelateNumber($sut, "?int:1", "colspan", "colSpan");
//	}
//
//	public function testHeaders():void {
//		/** @var HTMLTableCellElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("td");
//		self::assertPropertyAttributeCorrelate($sut, "headers");
//	}
//
//	public function testRowSpan():void {
//		/** @var HTMLTableCellElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("td");
//		self::assertPropertyAttributeCorrelateNumber($sut, "?int:1", "rowspan", "rowSpan");
//	}
//
//	public function testScope():void {
//		/** @var HTMLTableCellElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("td");
//		self::assertPropertyAttributeCorrelate($sut, "scope");
//	}
}
