<?php
namespace Gt\Dom\Test;

use Gt\Dom\DOMParser;
use Gt\Dom\Exception\MimeTypeNotSupportedException;
use PHPUnit\Framework\TestCase;

class DOMParserTest extends TestCase {
	public function testParseFromStringUnknownType():void {
		$sut = new DOMParser();
		self::expectException(MimeTypeNotSupportedException::class);
		$sut->parseFromString("", "text/unknown");
	}
}
