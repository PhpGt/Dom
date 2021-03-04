<?php
namespace Gt\Dom\Test;

use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use PHPUnit\Framework\TestCase;

class DocumentTypeTest extends TestCase {
	public function testTextContentHTML():void {
		$sut = DocumentTestFactory::createHTMLDocument()->doctype;
		self::assertNull($sut->textContent);
	}

	public function testTextContentXML():void {
		$sut = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_BOOK)->doctype;
		self::assertNull($sut->textContent);
	}
}
