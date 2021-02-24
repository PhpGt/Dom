<?php
namespace Gt\Dom\Test;

use Gt\Dom\DOMParser;
use Gt\Dom\Exception\MimeTypeNotSupportedException;
use Gt\Dom\HTMLDocument;
use Gt\Dom\XMLDocument;
use PHPUnit\Framework\TestCase;

class DOMParserTest extends TestCase {
	public function testParseFromStringUnknownType():void {
		$sut = new DOMParser();
		self::expectException(MimeTypeNotSupportedException::class);
		$sut->parseFromString("", "text/unknown");
	}

	public function testParseFromStringEmptyHTML():void {
		$sut = new DOMParser();
		$doc = $sut->parseFromString("", "text/html");
		self::assertInstanceOf(HTMLDocument::class, $doc);
	}

	public function testParseFromStringEmptyXML():void {
		$sut = new DOMParser();
		$doc1 = $sut->parseFromString("", "text/xml");
		$doc2 = $sut->parseFromString("", "application/xml");
		$doc3 = $sut->parseFromString("", "application/xhtml+xml");
		self::assertInstanceOf(XMLDocument::class, $doc1);
		self::assertInstanceOf(XMLDocument::class, $doc2);
		self::assertInstanceOf(XMLDocument::class, $doc3);
	}

	public function testParseFromStringEmptySVG():void {
		$sut = new DOMParser();
		$doc = $sut->parseFromString("", "image/svg+xml");
		self::assertInstanceOf(XMLDocument::class, $doc);
	}
}
