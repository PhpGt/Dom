<?php
namespace Gt\Dom\Test;

use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use Gt\Dom\XMLDocument;
use PHPUnit\Framework\TestCase;

class DOMImplementationTest extends TestCase {
	public function testHasFeature():void {
		$sut = DocumentTestFactory::createDOMImplementation();
		self::assertTrue($sut->hasFeature("anything", "anything"));
	}

	public function testCreateDocument():void {
		$sut = DocumentTestFactory::createDOMImplementation();
		/** @var XMLDocument $document */
		$document = $sut->createDocument(
			"testnamespace",
			"test:phpunit"
		);
		self::assertInstanceOf(XMLDocument::class, $document);
	}

	public function testCreateDocumentType():void {
		$sut = DocumentTestFactory::createDOMImplementation();
		$documentType = $sut->createDocumentType(
			"test",
			"public",
			"system"
		);
		self::assertSame("test", $documentType->nodeName);
		self::assertSame("public", $documentType->publicId);
		self::assertSame("system", $documentType->systemId);
	}
}
