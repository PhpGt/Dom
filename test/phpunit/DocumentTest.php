<?php
namespace Gt\Dom\Test;

use Gt\Dom\Document;
use Gt\Dom\DocumentType;
use Gt\Dom\Element;
use Gt\Dom\HTMLElement\HTMLBodyElement;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use Gt\PropFunc\PropertyReadOnlyException;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase {
	public function testToStringEmpty():void {
		$sut = new Document();
		self::assertEquals(PHP_EOL, (string)$sut);
	}

	public function testBodyNullByDefault():void {
		$sut = new Document();
		self::assertNull($sut->body);
	}

	public function testBodyReadOnly():void {
		$sut = new Document();
		$property = "body";
		self::expectException(PropertyReadOnlyException::class);
		/** @phpstan-ignore-next-line */
		$sut->$property = "can-not-set";
	}

	public function testBodyInstanceOfHTMLBodyElementEmptyHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument("");
		self::assertInstanceOf(HTMLBodyElement::class, $sut->body);
	}

	public function testBodyInstanceOfHTMLBodyElementDefaultHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		self::assertInstanceOf(HTMLBodyElement::class, $sut->body);
	}

	public function testToStringEmptyHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument("");
		self::assertEquals("<!DOCTYPE html>\n<html><head></head><body></body></html>\n", (string)$sut);
	}

	public function testToStringDefaultHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertEquals("<!DOCTYPE html>\n<html><head></head><body><h1>Hello, PHP.Gt!</h1></body></html>\n", (string)$sut);
	}

	public function testBodyNullOnXML():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertNull($sut->body);
	}

	public function testToStringEmptyXML():void {
		$sut = DocumentTestFactory::createXMLDocument("");
		self::assertEquals("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n", (string)$sut);
	}

	public function testCharacterSetUnset():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertEquals("", $sut->characterSet);
	}

	public function testCharacterSetUTF8():void {
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_DEFAULT_UTF8);
		self::assertEquals("UTF-8", $sut->characterSet);
	}

	public function testContentTypeEmpty():void {
		$sut = new Document();
		self::assertEquals("", $sut->contentType);
	}

	public function testContentTypeHTMLDocument():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertEquals("text/html", $sut->contentType);
	}

	public function testContentTypeXMLDocument():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertEquals("text/xml", $sut->contentType);
	}

	public function testDoctypeEmpty():void {
		$sut = new Document();
		self::assertNull($sut->doctype);
	}

	public function testDoctypeHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertInstanceOf(DocumentType::class, $sut->doctype);
	}

	public function testDoctypeXML():void {
		$sut = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_BOOK);
		self::assertInstanceOf(DocumentType::class, $sut->doctype);
	}

	public function testDocumentElementEmpty():void {
		$sut = new Document();
		self::assertNull($sut->documentElement);
	}

	public function testDocumentElementHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument();
		self::assertInstanceOf(Element::class, $sut->documentElement);
	}

	public function testDocumentElementXML():void {
		$sut = DocumentTestFactory::createXMLDocument();
		self::assertInstanceOf(Element::class, $sut->documentElement);
	}
}
