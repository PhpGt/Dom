<?php

namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\HierarchyRequestError;
use Gt\Dom\HTMLCollection;
use TypeError;
use Gt\Dom\Exception\IndexSizeException;
use Gt\Dom\HTMLElement\HTMLTableElement;
use Gt\Dom\HTMLElement\HTMLTableCaptionElement;
use Gt\Dom\HTMLElement\HTMLTableSectionElement;
use Gt\Dom\HTMLElement\HTMLTableRowElement;
use PHPUnit\Framework\TestCase;
use Gt\Dom\Test\TestFactory\NodeTestFactory;


class HTMLTableElementTest extends TestCase
{
    public function testCreateTable(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        self::assertInstanceOf(HTMLTableElement::class, $table);
    }

    public function testCreateTHead(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('thead');
        $table->createTHead();
        $thead = $table->createTHead();
        self::assertInstanceOf(HTMLTableSectionElement::class, $thead);
        self::assertCount(1, $col);
    }

    public function testCreateTHeadPosition(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $table->createCaption();
        $colgroup = $table->ownerDocument->createElement('colgroup');
        $table->appendChild($colgroup);
        $table->createTBody();
        $table->createTFoot();
        $thead = $table->createTHead();
        self::assertSame($table->childNodes[2], $thead);
    }

    public function testDeleteTHead(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('thead');
        $table->createTHead();
        $table->deleteTHead();
        self::assertCount(0, $col);
    }

    public function testCreateTFoot(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tfoot');
        $table->createTFoot();
        $tfoot = $table->createTFoot();
        self::assertInstanceOf(HTMLTableSectionElement::class, $tfoot);
        self::assertCount(1, $col);
    }

    public function testCreateTFootPosition(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $table->createCaption();
        $colgroup = $table->ownerDocument->createElement('colgroup');
        $table->appendChild($colgroup);
        $table->createTHead();
        $table->createTBody();
        $thead = $table->createTFoot();
        self::assertSame($table->childNodes[4], $thead);
    }

    public function testDeleteTFoot(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tfoot');
        $table->createTFoot();
        $table->deleteTFoot();
        self::assertCount(0, $col);
    }

    public function testCreateTBody(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tbody');
        $tbody = $table->createTBody();
        self::assertInstanceOf(HTMLTableSectionElement::class, $tbody);
        $table->createTBody();
        self::assertCount(2, $col);
    }

    public function testCreateTBodyPosition(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $table->createCaption();
        $colgroup = $table->ownerDocument->createElement('colgroup');
        $table->appendChild($colgroup);
        $table->createTHead();
        $tbody = $table->createTBody();
        self::assertSame($table->lastElementChild, $tbody);
        $tbody = $table->createTBody();
        self::assertSame($table->lastElementChild, $tbody);
    }

    public function testCreateCaption(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('caption');
        $table->createCaption();
        $caption = $table->createCaption();
        self::assertInstanceOf(HTMLTableCaptionElement::class, $caption);
        self::assertSame($table->firstElementChild, $caption);
        self::assertCount(1, $col);
    }

    public function testDeleteCaption(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('caption');
        $table->createCaption();
        $table->deleteCaption();
        self::assertCount(0, $col);
    }

    public function testInsertRow(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tr');
        $tr = $table->insertRow();
        self::assertInstanceOf(HTMLTableRowElement::class, $tr);
        $table->insertRow();
        self::assertCount(2, $col);
    }

    public function testInsertRowRangeBelow(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $this->expectException(IndexSizeException::class);
        $table->insertRow();
        $table->insertRow(-3);
    }

    public function testInsertRowRangeAbove(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $this->expectException(IndexSizeException::class);
        $table->insertRow();
        $table->insertRow(3);
    }

    public function testInsertRowLast(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tr');
        $table->insertRow();
        $table->insertRow();
        $tr = $table->insertRow(-1);
        self::assertSame($col->item(2), $tr);
        $tr = $table->insertRow(3);
        self::assertSame($col->item(3), $tr);
    }

    public function testInsertRowBetween(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tr');
        $table->insertRow();
        $tr = $table->insertRow();
        $trBefore = $table->insertRow(1);
        self::assertSame($col->item(1), $trBefore);
        self::assertSame($col->item(2), $tr);
    }

    public function testInsertRowBodyLast(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $table->createTBody();
        $table->createTBody();
        $tr = $table->insertRow();
        self::assertSame($table->lastElementChild, $tr->parentNode);
    }

    public function testDeleteRow(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tr');
        $table->insertRow();
        $table->insertRow();
        $table->deleteRow(0);
        self::assertCount(1, $col);
    }

    public function testDeleteRowRangeBelow(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $this->expectException(IndexSizeException::class);
        $table->deleteRow(-3);
    }

    public function testDeleteRowRangeAbove(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $this->expectException(IndexSizeException::class);
        $table->insertRow();
        $table->insertRow();
        $table->insertRow();
        $table->deleteRow(3);
    }

    public function testDeleteRowLast(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tr');
        $table->insertRow();
        $table->insertRow();
        $table->insertRow();
        $table->deleteRow(-1);
        self::assertCount(2, $col);
    }

    public function testGetCaption(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        self::assertNull($table->caption);
        $table->createCaption();
        self::assertInstanceOf(HTMLTableCaptionElement::class, $table->caption);
        self::assertSame($table, $table->caption->parentNode);
        self::assertSame($table->querySelector('caption:first-of-type'), $table->caption);
    }

    public function testSetCaption(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('caption');
        $document = $table->ownerDocument;
        $table->caption = $document->createElement('caption');
        self::assertSame($table->firstElementChild, $table->caption);
        self::assertCount(1, $col);
        $table->caption = null;
        self::assertCount(0, $col);
    }

    public function testSetCaptionWrongType(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $this->expectException(TypeError::class);
        $table->caption = $table->ownerDocument->createElement('div');
    }

    public function testGetTHead(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        self::assertNull($table->tHead);
        $table->createTHead();
        self::assertInstanceOf(HTMLTableSectionElement::class, $table->tHead);
        self::assertSame($table, $table->tHead->parentNode);
        self::assertSame($table->querySelector('thead:first-of-type'), $table->tHead);
    }

    public function testSetTHead(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $document = $table->ownerDocument;
        $col = $table->getElementsByTagName('thead');
        $table->tHead = $document->createElement('thead');
        self::assertSame($table->firstElementChild, $table->tHead);
        $table->tHead = null;
        self::assertCount(0, $col);
    }

    public function testSetTHeadPosition(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $document = $table->ownerDocument;
        $col = $table->getElementsByTagName('thead');
        $table->createCaption();
        $table->appendChild($document->createElement('colgroup'));
        $table->createTBody();
        $table->createTFoot();
        $table->tHead = $document->createElement('thead');
        self::assertSame($table->childNodes[2], $table->tHead);
        $table->tHead = null;
        self::assertCount(0, $col);
    }

    public function testSetTHeadWrongType(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $this->expectException(TypeError::class);
        $this->expectException(HierarchyRequestError::class);
        $table->tHead = $table->ownerDocument->createElement('tbody');
    }

    public function testGetTFoot(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        self::assertNull($table->tFoot);
        $table->createTFoot();
        self::assertInstanceOf(HTMLTableSectionElement::class, $table->tFoot);
        self::assertSame($table, $table->tFoot->parentNode);
        self::assertSame($table->querySelector('tfoot:first-of-type'), $table->tFoot);
    }

    public function testSetTfoot(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $col = $table->getElementsByTagName('tfoot');
        $table->tFoot = $table->ownerDocument->createElement('tfoot');
        self::assertSame($table->lastElementChild, $table->tFoot);
        $table->tFoot = null;
        self::assertCount(0, $col);
    }

    public function testSetTfootPosition(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $document = $table->ownerDocument;
        $table->createCaption();
        $colgroup = $document->createElement('colgroup');
        $table->appendChild($colgroup);
        $table->createTHead();
        $table->createTBody();
        $table->tFoot = $document->createElement('tfoot');
        self::assertSame($table->lastElementChild, $table->tFoot);
    }

    public function testSetTFootWrongType(): void
    {
        $table = NodeTestFactory::createHTMLElement('table');
        $this->expectException(TypeError::class);
        $this->expectException(HierarchyRequestError::class);
        $table->tFoot = $table->ownerDocument->createElement('thead');
    }

    public function testGetRowsOrder() {
        $table = NodeTestFactory::createHTMLElement('table');
        self::assertInstanceOf(HTMLCollection::class, $table->rows);
        $table->createTBody();
        $row = $table->insertRow();
        $row->id = '3';
        $row = $table->insertRow();
        $row->id = '4';
        $el = $table->createTFoot();
        $row = $table->ownerDocument->createElement('tr');
        $row->id = '5';
        $el->appendChild($row);
        $el = $table->createTHead();
        $row = $table->ownerDocument->createElement('tr');
        $row->id = '1';
        $el->appendChild($row);
        $row = $table->ownerDocument->createElement('tr');
        $row->id = '2';
        $el->appendChild($row);
        $table->createTBody();
        $row = $table->insertRow();
        $row->id = '6';
        $i = 1;
        self::assertCount(6, $table->rows);
        foreach ($table->rows as $row) {
            self::assertEquals((string)$i, $row->id);
            $i++;
        }
    }
    public function testGetRowsDirectChildrenOnly()
    {
        $table1 = NodeTestFactory::createHTMLElement('table');
        $table2 = $table1->ownerDocument->createElement('table');
        $table1->createTBody();
        $tr1 = $table1->insertRow();
        $td1 = $table1->ownerDocument->createElement('td');
        $tr1->appendChild($td1);
        $table1->insertRow();
        $table2->createTBody();
        $table2->insertRow();
        $table2->insertRow();
        $td1->appendChild($table2);
        self::assertCount(2, $table1->rows);
    }

    public function testGetTBodies() {
        $table = NodeTestFactory::createHTMLElement('table');
        self::assertInstanceOf(HTMLCollection::class, $table->tBodies);
        $table->createTHead();
        $table->createTBody();
        $table->appendChild($table->ownerDocument->createElement('tr'));
        self::assertInstanceOf(HTMLCollection::class, $table->tBodies);
        foreach($table->tBodies as $tbody) {
            self::assertEquals('tbody', $tbody->nodeName);
            self::assertSame($table, $tbody->parentNode);
        }
    }
}