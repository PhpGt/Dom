<?php
namespace Gt\Dom\Test;

use Gt\Dom\DocumentType;
use Gt\Dom\ElementType;
use Gt\Dom\HTMLDocument;
use Gt\Dom\XMLDocument;
use Gt\PropFunc\PropertyDoesNotExistException;
use PHPUnit\Framework\TestCase;

class XMLDocumentTest extends TestCase {
	public function testBodyNullOnXML():void {
		$sut = new XMLDocument();
		self::expectException(PropertyDoesNotExistException::class);
		/** @noinspection PhpExpressionResultUnusedInspection */
		/** @noinspection PhpUndefinedFieldInspection */
		$sut->body;
	}


	public function testToStringEmptyXML():void {
		$sut = new XMLDocument();
		self::assertEquals("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<xml/>\n", (string)$sut);
	}

	public function testPropContentTypeEmpty():void {
		$sut = new XMLDocument();
		self::assertEquals("application/xml", $sut->contentType);
	}

	public function testDoctype():void {
		$sut = new HTMLDocument();
		self::assertInstanceOf(DocumentType::class, $sut->doctype);
	}

	public function testDocumentElementXML():void {
		$sut = new XMLDocument();
		self::assertSame(ElementType::Element, $sut->documentElement->elementType);
	}

//	public function testEvaluate():void {
//		$sut = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_BREAKFAST_MENU);
//
//		$i = null;
//		foreach($sut->evaluate("//food") as $i => $foodElement) {
//			self::assertInstanceOf(Element::class, $foodElement);
//		}
//
//		self::assertSame(4, $i);
//	}
}
