<?php
namespace Gt\Dom\Test;

use Error;
use Gt\Dom\Facade\HTMLDocumentFactory;
use PHPUnit\Framework\TestCase;
use Gt\Dom\HTMLDocument;
use Throwable;

class HTMLDocumentTest extends TestCase {
	public function testCanConstruct():void {
		$exception = null;

		try {
			new HTMLDocument();
		}
		catch(Throwable $exception) {}

		self::assertNull($exception);
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

//	public function testCreatedWithNoDocType():void {
//		$sut = HTMLDocumentFactory::create("<html><body><h1>Hello!</h1></body></html>");
//		echo $sut;
//	}
}
