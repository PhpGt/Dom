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
}
