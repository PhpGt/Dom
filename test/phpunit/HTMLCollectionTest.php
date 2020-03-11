<?php
namespace Gt\Dom\Test;

use ArrayAccess;
use BadMethodCallException;
use DOMNodeList;
use Gt\Dom\Element;
use Gt\Dom\HTMLCollection;
use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use Gt\Dom\Text;
use PHPUnit\Framework\TestCase;

class HTMLCollectionTest extends TestCase {
	public function testType() {
		$document = new HTMLDocument(Helper::HTML);
		$this->assertInstanceOf(HTMLCollection::class, $document->children);
	}

	public function testNonElementsRemoved() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$bodyChildNodes = $document->body->childNodes;
		$bodyChildren = $document->body->children;

		$this->assertInstanceOf(DOMNodeList::class, $bodyChildNodes);
		$this->assertInstanceOf(HTMLCollection::class, $bodyChildren);

		$this->assertInstanceOf(Text::class, $bodyChildNodes->item(0));
		$this->assertInstanceOf(Element::class, $bodyChildren->item(0));
	}

	public function testArrayAccessImplementation() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$collection = $document->body->children;

// test if the collection implements ArrayAccess
		$this->assertInstanceOf(ArrayAccess::class, $collection);

// test if offset 0 exists
		$this->assertArrayHasKey(0, $collection);

// test if the first item is an Element instance
		$first = $collection[0];
		$this->assertInstanceOf(Element::class, $first);

// test if the collection is read only
		$this->expectException(BadMethodCallException::class);
		$collection[$collection->length] = new Element('br');
		unset($collection[0]);

	}

	public function testCountMethod() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$childrenCount = count($document->body->children);
		$this->assertEquals(11, $childrenCount);
	}

	public function testNamedItem() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$whoNamed = $document->body->children->namedItem("who");
		$whoH2 = $document->getElementById("who");

		$this->assertSame($whoNamed, $whoH2,
			"Named item should match by id first");

		$formsNamed = $document->body->children->namedItem("forms");
		$formsAnchor = $document->querySelector("a[name='forms']");

		$this->assertSame($formsNamed, $formsAnchor,
			"Named item should match name when no id match");
	}

	public function testIteration() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		foreach($document->querySelectorAll("p") as $i => $p) {
			$paragraphItem = $document->getElementsByTagName("p")[$i];
			$this->assertSame($paragraphItem, $p);
		}
	}

	public function testLengthProperty() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$nodeList = $document->querySelectorAll("form>input");
		$this->assertCount(3, $nodeList);
		$this->assertEquals(3, $nodeList->length);
	}

	public function testItemProperty() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$nodeList = $document->getElementsByTagName("p");
		$first = $nodeList->item(0);
		$third = $nodeList->item(2);

		$this->assertStringContainsString("There are a few elements", $first->textContent);
		$this->assertTrue($third->classList->contains("plug"));
	}
}