<?php
namespace Gt\Dom\Test;

use Gt\Dom\DocumentType;
use Gt\Dom\ElementType;
use Gt\Dom\Exception\InvalidCharacterException;
use Gt\Dom\Exception\WriteOnNonHTMLDocumentException;
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

	public function testHeadNullOnXML():void {
		$sut = new XMLDocument();
		self::expectException(PropertyDoesNotExistException::class);
		/** @noinspection PhpExpressionResultUnusedInspection */
		/** @noinspection PhpUndefinedFieldInspection */
		/** @phpstan-ignore-next-line */
		$sut->head;
	}

	public function testWriteDirectlyToDocument():void {
		$message = "Hello from PHPUnit!";
		$sut = new XMLDocument();
		self::expectException(WriteOnNonHTMLDocumentException::class);
		$sut->open();
		$sut->write($message);
	}

	public function testCreateCDATASection():void {
		$sut = new XMLDocument();
		$data = "Example CDATASection data!";
		$cdata = $sut->createCDATASection($data);
		self::assertEquals($data, $cdata->nodeValue);
	}

	public function testCreateCDATASectionInvalidCharacter():void {
		$sut = new XMLDocument();
		$data = "Illegal Characters ]]>";
		self::expectException(InvalidCharacterException::class);
		$sut->createCDATASection($data);
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
