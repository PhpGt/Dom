<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\IndexIsNegativeOrGreaterThanAllowedAmountException;
use Gt\Dom\HTMLElement\HTMLTableRowElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTableRowElementTest extends HTMLElementTestCase {
	public function testDeleteCellEmpty():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		self::expectException(IndexIsNegativeOrGreaterThanAllowedAmountException::class);
		$sut->deleteCell(0);
	}

	public function testDeleteCell():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		$tdArray = [];
		for($i = 0; $i < 10; $i++) {
			$td = $sut->ownerDocument->createElement("td");
			$sut->appendChild($td);
			array_push($tdArray, $td);
		}

		$sut->deleteCell(4);

		foreach($tdArray as $i => $td) {
			$actualIndex = $i;

			if($i === 4) {
				continue;
			}
			if($i > 4) {
				$actualIndex = $i - 1;
			}

			self::assertSame($td, $sut->getElementsByTagName("td")->item($actualIndex));
		}
	}

	public function testInsertCell():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");

		$td1 = $sut->insertCell();
		$td2 = $sut->insertCell();
		$td3 = $sut->insertCell();

		self::assertSame($td1, $sut->getElementsByTagName("td")->item(0));
		self::assertSame($td2, $sut->getElementsByTagName("td")->item(1));
		self::assertSame($td3, $sut->getElementsByTagName("td")->item(2));
	}

	public function testInsertCellIndex():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");

		$td1 = $sut->insertCell();
		$td1->id = "td1";
		$td2 = $sut->insertCell();
		$td2->id = "td2";
		$td3 = $sut->insertCell();
		$td3->id = "td3";

		$tdNew = $sut->insertCell(1);
		$tdNew->id = "tdNew";

		self::assertSame($tdNew, $sut->getElementsByTagName("td")->item(1));
		self::assertSame($td1, $sut->getElementsByTagName("td")->item(0));
		self::assertSame($td2, $sut->getElementsByTagName("td")->item(2));
		self::assertSame($td3, $sut->getElementsByTagName("td")->item(3));
	}

	public function testCells():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		$cells = $sut->cells;

		self::assertCount(0, $cells);
		$sut->insertCell();
		self::assertCount(1, $cells);
		$sut->deleteCell(0);
		self::assertCount(0, $cells);
	}
}
