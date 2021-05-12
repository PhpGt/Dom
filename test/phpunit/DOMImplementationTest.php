<?php
namespace Gt\Dom\Test;

use Gt\Dom\DocumentType;
use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use Gt\Dom\XMLDocument;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

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

	public function testCreateHTMLDocument():void {
		$sut = DocumentTestFactory::createDOMImplementation();
		$document = $sut->createHTMLDocument("example");
		self::assertSame("example", $document->title);
	}

	public function testCreateDocument_withExistingDocumentType():void {
		$document = DocumentTestFactory::createHTMLDocument();
		$sut = DocumentTestFactory::createDOMImplementation();
		$newDocument = $sut->createDocument(
			"example-ns",
			"example-qn",
			$document->doctype
		);

		/** @var DocumentType $newType */
		$newType = $newDocument->doctype;
		self::assertNotSame($document->doctype, $newType);
		self::assertEquals($document->doctype->name, $newType->name);
		self::assertEquals($document->doctype->systemId, $newType->systemId);
		self::assertEquals($document->doctype->publicId, $newType->publicId);
	}
}
