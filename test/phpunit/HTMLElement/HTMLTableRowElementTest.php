<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\IndexIsNegativeOrGreaterThanAllowedAmountException;
use Gt\Dom\Exception\IndexSizeException;
use Gt\Dom\HTMLElement\HTMLTableElement;
use Gt\Dom\HTMLElement\HTMLTableRowElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTableRowElementTest extends HTMLElementTestCase {
	public function testDeleteCellEmpty():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		self::expectException(IndexSizeException::class);
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

	public function testRowIndexNotInTable():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		self::assertSame(-1, $sut->rowIndex);
	}

	public function testRowIndex():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		$table = $sut->ownerDocument->createElement("table");
		$table->appendChild($sut);
		self::assertSame(0, $sut->rowIndex);

		$table->prepend($sut->ownerDocument->createElement("td"));
		$table->prepend($sut->ownerDocument->createElement("td"));
		$table->prepend($sut->ownerDocument->createElement("td"));

		self::assertSame(3, $sut->rowIndex);
	}

	public function testRowIndexSectionsBody():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		/** @var HTMLTableElement $table */
		$table = $sut->ownerDocument->createElement("table");
		$thead = $table->createTHead();
		$thead->insertRow();
		$thead->insertRow();
		$thead->insertRow();
		$tbody = $table->createTBody();
		$tbody->insertRow();
		$tbody->appendChild($sut);
		$tfoot = $table->createTFoot();
		$tfoot->insertRow();
		$tfoot->insertRow();
		$tfoot->insertRow();
// Head, body and foot are out of order! This should not affect the row index.
		$table->append($tfoot, $thead, $tbody);
		self::assertSame(4, $sut->rowIndex);
	}

	public function testRowIndexSectionsHead():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		/** @var HTMLTableElement $table */
		$table = $sut->ownerDocument->createElement("table");
		$thead = $table->createTHead();
		$thead->insertRow();
		$thead->appendChild($sut);
		$tbody = $table->createTBody();
		$tbody->insertRow();
		$tbody->insertRow();
		$tbody->insertRow();
		$tbody->insertRow();
		$tbody->insertRow();
		$tfoot = $table->createTFoot();
		$tfoot->insertRow();
		$tfoot->insertRow();
		$tfoot->insertRow();
		$tfoot->insertRow();
// Head, body and foot are out of order! This should not affect the row index.
		$table->append($tbody, $tfoot, $thead);
		self::assertSame(1, $sut->rowIndex);
	}

	public function testRowIndexSectionsFoot():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		/** @var HTMLTableElement $table */
		$table = $sut->ownerDocument->createElement("table");
		$thead = $table->createTHead();
		$thead->insertRow();
		$thead->insertRow();
		$tbody = $table->createTBody();
		$tbody->insertRow();
		$tbody->insertRow();
		$tbody->insertRow();
		$tbody->insertRow();
		$tbody->insertRow();
		$tfoot = $table->createTFoot();
		$tfoot->insertRow();
		$tfoot->insertRow();
		$tfoot->insertRow();
		$tfoot->insertRow();
		$tfoot->appendChild($sut);
// Head, body and foot are out of order! This should not affect the row index.
		$table->append($tbody, $tfoot, $thead);
		self::assertSame(11, $sut->rowIndex);
	}

	public function testRowIndexSectionsFootWithSectionsInOrder():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		/** @var HTMLTableElement $table */
		$table = $sut->ownerDocument->createElement("table");
		$thead = $table->createTHead();
		$thead->insertRow();
		$tbody = $table->createTBody();
		$tbody->insertRow();
		$tfoot = $table->createTFoot();
		$tfoot->insertRow();
		$tfoot->appendChild($sut);
		$table->append($thead, $tbody, $tfoot);
		self::assertSame(3, $sut->rowIndex);
	}

	public function testRowIndexSectionsFootWithEmptySections():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		/** @var HTMLTableElement $table */
		$table = $sut->ownerDocument->createElement("table");
		$thead = $table->createTHead();
		$tbody = $table->createTBody();
		$tfoot = $table->createTFoot();
		$tfoot->appendChild($sut);
		$table->append($thead, $tbody, $tfoot);
		self::assertSame(0, $sut->rowIndex);
	}

	public function testSectionRowIndexEmpty():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		self::assertSame(-1, $sut->sectionRowIndex);
	}

	public function testSectionRowIndexFirst():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		$tbody = $sut->ownerDocument->createElement("tbody");
		$tbody->appendChild($sut);
		self::assertSame(0, $sut->sectionRowIndex);
		$tbody->appendChild($sut->cloneNode());
		$tbody->appendChild($sut->cloneNode());
		$tbody->appendChild($sut->cloneNode());
		$tbody->appendChild($sut->cloneNode());
		self::assertSame(0, $sut->sectionRowIndex);
	}

	public function testSectionRowIndex():void {
		/** @var HTMLTableRowElement $sut */
		$sut = NodeTestFactory::createHTMLElement("tr");
		$tbody = $sut->ownerDocument->createElement("tbody");
		$tbody->appendChild($sut->cloneNode());
		$tbody->appendChild($sut->cloneNode());
		$tbody->appendChild($sut->cloneNode());
		$tbody->appendChild($sut->cloneNode());
		$tbody->appendChild($sut);
		self::assertSame(4, $sut->sectionRowIndex);
	}
}
