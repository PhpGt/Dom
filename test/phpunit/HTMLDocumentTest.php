<?php
namespace Gt\Dom\Test;

use Error;
use Gt\Dom\Facade\HTMLDocumentFactory;
use PHPUnit\Framework\TestCase;
use Gt\Dom\HTMLDocument;

class HTMLDocumentTest extends TestCase {
	public function testCanNotConstruct():void {
		self::expectException(Error::class);
		self::expectExceptionMessage("Call to protected Gt\Dom\HTMLDocument::__construct()");
		$className = HTMLDocument::class;
		/** @phpstan-ignore-next-line */
		new $className();
	}

	public function testCreatesRootNode():void {
		$sut = HTMLDocumentFactory::create("<h1>Test</h1>");
		self::assertEquals(
			"HTML",
			$sut->documentElement->tagName
		);
	}

	public function testCreatedElementsAreNotNamespaced():void {
		$sut = HTMLDocumentFactory::create('<html lang="en"><head><title>Test</title></head><body></body></html>');
		$div = $sut->createElement("div");
		$sut->body->appendChild($div);
		self::assertEquals(
			"<div></div>",
			$sut->body->innerHTML
		);
	}
}
