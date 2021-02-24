<?php
namespace Gt\Dom\Test;

use Gt\Dom\Document;
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
		$sut = DocumentTestFactory::createHTMLDocument(DocumentTestFactory::HTML_DEFAULT);
		self::assertEquals("<!DOCTYPE html>\n<html><head></head><body><h1>Hello, PHP.Gt!</h1></body></html>\n", (string)$sut);
	}
}
