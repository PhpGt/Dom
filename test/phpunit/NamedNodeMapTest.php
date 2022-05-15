<?php
namespace Gt\Dom\Test;

use Gt\Dom\Attr;
use Gt\Dom\Document;
use Gt\Dom\Element;
use Gt\Dom\Exception\NamedNodeMapImmutableException;
use Gt\Dom\Facade\DOMDocumentFacade;
use Gt\Dom\Facade\NamedNodeMapFactory;
use PHPUnit\Framework\TestCase;

class NamedNodeMapTest extends TestCase {
//	public function testLength():void {
//		$document = new DOMDocumentFacade(new Document());
//		$nativeElement = $document->createElement("example");
//		$nativeElement->setAttribute("one", "abc");
//		$nativeElement->setAttribute("two", "xyz");
//		/** @var Element $element */
//		$element = $document->getGtDomNode($nativeElement);
//		$sut = NamedNodeMapFactory::create(fn() => $nativeElement->attributes, $element);
//		self::assertEquals(2, $sut->length);
//		self::assertCount(2, $sut);
//	}
//
//	public function testGetNamedItem():void {
//		$document = new DOMDocumentFacade(new Document());
//		$nativeElement = $document->createElement("example");
//		$nativeElement->setAttribute("one", "abc");
//		$nativeElement->setAttribute("two", "xyz");
//		/** @var Element $element */
//		$element = $document->getGtDomNode($nativeElement);
//		$sut = NamedNodeMapFactory::create(fn() => $nativeElement->attributes, $element);
//		$item = $sut->getNamedItem("two");
//		self::assertInstanceOf(Attr::class, $item);
//		self::assertEquals("xyz", $item->value);
//	}
//
//	public function testGetNamedItemNone():void {
//		$document = new DOMDocumentFacade(new Document());
//		$nativeElement = $document->createElement("example");
//		/** @var Element $element */
//		$element = $document->getGtDomNode($nativeElement);
//		$sut = NamedNodeMapFactory::create(fn() => $nativeElement->attributes, $element);
//		$item = $sut->getNamedItem("two");
//		self::assertNull($item);
//	}
//
//	public function testGetNamedItemNS():void {
//		$ns = "example_namespace";
//
//		$document = new Document();
//		/** @var Element $element */
//		$element = $document->createElementNS(
//			$ns,
//			"test:example"
//		);
//		$element->setAttributeNS(
//			$ns,
//			"test",
//			"abc"
//		);
//		$sut = $element->attributes->getNamedItemNS($ns, "test");
//		self::assertEquals(
//			"abc",
//			$sut->value
//		);
//	}
//
//	public function testGetNamedItemNSNone():void {
//		$ns = "example_namespace";
//
//		$document = new Document();
//		/** @var Element $element */
//		$element = $document->createElementNS(
//			$ns,
//			"test:example"
//		);
//		$element->setAttributeNS(
//			$ns,
//			"test",
//			"abc"
//		);
//		$sut = $element->attributes->getNamedItemNS($ns, "not-here");
//		self::assertNull(
//			$sut
//		);
//	}
//
//	public function testSetNamedItem():void {
//		$document = new Document();
//		$nativeDocument = new DOMDocumentFacade($document);
//		$nativeElement = $nativeDocument->createElement("example");
//		$nativeElement->setAttribute("one", "abc");
//		$nativeElement->setAttribute("two", "xyz");
//		/** @var Element $element */
//		$element = $nativeDocument->getGtDomNode($nativeElement);
//		$sut = $document->createAttribute("three");
//		$sut->value = "123";
//		self::assertNull($element->attributes->setNamedItem($sut));
//		self::assertEquals("abc", $element->getAttribute("one"));
//		self::assertEquals("xyz", $element->getAttribute("two"));
//		self::assertEquals("123", $element->getAttribute("three"));
//	}
//
//	public function testSetNamedItemExisting():void {
//		$document = new Document();
//		$nativeDocument = new DOMDocumentFacade($document);
//		$nativeElement = $nativeDocument->createElement("example");
//		$nativeElement->setAttribute("one", "abc");
//		$nativeElement->setAttribute("two", "xyz");
//		/** @var Element $element */
//		$element = $nativeDocument->getGtDomNode($nativeElement);
//		$sut = $document->createAttribute("two");
//		$sut->value = "qwerty";
//		self::assertNotNull($element->attributes->setNamedItem($sut));
//		self::assertEquals("abc", $element->getAttribute("one"));
//		self::assertEquals("qwerty", $element->getAttribute("two"));
//	}
//
//	public function testSetNamedItemNS():void {
//		$ns = "example_namespace";
//
//		$document = new Document();
//		/** @var Element $element */
//		$element = $document->createElementNS(
//			$ns,
//			"test:example"
//		);
//		$document->appendChild($element);
//		$attr = $document->createAttributeNS($ns, "test");
//		$attr->value = "abc";
//		self::assertNull($element->attributes->setNamedItemNS($attr));
//		$sut = $element->attributes->item(0);
//		self::assertEquals(
//			$ns,
//			$sut->namespaceURI
//		);
//		self::assertEquals(
//			"abc",
//			$sut->value
//		);
//	}
//
//	public function testSetNamedItemNSExisting():void {
//		$ns = "example_namespace";
//
//		$document = new Document();
//		/** @var Element $element */
//		$element = $document->createElementNS(
//			$ns,
//			"test:example"
//		);
//		$document->appendChild($element);
//		$attr = $document->createAttributeNS($ns, "test");
//		$attr->value = "abc";
//		self::assertNull($element->attributes->setNamedItemNS($attr));
//		self::assertNotNull($element->attributes->setNamedItemNS($attr));
//	}
//
//	public function testRemoveNamedItem():void {
//		$document = new Document();
//		$nativeDocument = new DOMDocumentFacade($document);
//		$nativeElement = $nativeDocument->createElement("example");
//		$nativeElement->setAttribute("one", "abc");
//		$nativeElement->setAttribute("two", "xyz");
//		/** @var Element $element */
//		$element = $nativeDocument->getGtDomNode($nativeElement);
//		$sut = $document->createAttribute("two");
//		self::assertSame($sut, $element->attributes->removeNamedItem($sut));
//	}
//
//	public function testRemoveNamedItemNS():void {
//		$ns = "example_namespace";
//
//		$document = new Document();
//		/** @var Element $element */
//		$element = $document->createElementNS(
//			$ns,
//			"test:example"
//		);
//		$document->appendChild($element);
//		$attr = $document->createAttributeNS($ns, "test");
//		$attr->value = "abc";
//		$element->attributes->setNamedItemNS($attr);
//		self::assertCount(1, $element->attributes);
//		$element->attributes->removeNamedItemNS($ns, $attr);
//		self::assertCount(0, $element->attributes);
//	}
//
//	public function testOffsetExistsString():void {
//		$document = new DOMDocumentFacade(new Document());
//		$nativeElement = $document->createElement("example");
//		$nativeElement->setAttribute("one", "abc");
//		$nativeElement->setAttribute("two", "xyz");
//		/** @var Element $element */
//		$element = $document->getGtDomNode($nativeElement);
//		self::assertTrue(isset($element->attributes["one"]));
//		self::assertTrue(isset($element->attributes["two"]));
//		self::assertFalse(isset($element->attributes["three"]));
//	}
//
//	public function testOffsetGetString():void {
//		$document = new DOMDocumentFacade(new Document());
//		$nativeElement = $document->createElement("example");
//		$nativeElement->setAttribute("one", "abc");
//		$nativeElement->setAttribute("two", "xyz");
//		/** @var Element $element */
//		$element = $document->getGtDomNode($nativeElement);
//		self::assertEquals("abc", $element->attributes["one"]->value);
//		self::assertEquals("xyz", $element->attributes["two"]->value);
//		self::assertNull($element->attributes["three"]);
//	}
//
//	public function testOffsetSetImmutable():void {
//		$owner = self::createMock(Element::class);
//		$sut = NamedNodeMapFactory::create(fn() => null, $owner);
//		self::expectException(NamedNodeMapImmutableException::class);
//		$sut["something"] = "nothing";
//	}
//
//	public function testOffsetUnsetImmutable():void {
//		$owner = self::createMock(Element::class);
//		$sut = NamedNodeMapFactory::create(fn() => null, $owner);
//		self::expectException(NamedNodeMapImmutableException::class);
//		unset($sut["something"]);
//	}
}
