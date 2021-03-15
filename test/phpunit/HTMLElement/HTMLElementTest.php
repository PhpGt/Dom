<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\Test\TestFactory\HTMLElementTestFactory;
use PHPUnit\Framework\TestCase;

class HTMLElementTest extends TestCase {
	public function testAccessKeyNone():void {
		$sut = HTMLElementTestFactory::create("div");
		self::assertNull($sut->accessKey);
	}

	public function testAccessKeySetGet():void {
		$sut = HTMLElementTestFactory::create("div");
		$sut->accessKey = "a";
		self::assertEquals("a", $sut->accessKey);
		self::assertEquals(
			"a",
			$sut->getAttribute("accesskey")
		);
	}

	public function testAccessKeyLabelThrows():void {
		$sut = HTMLElementTestFactory::create("div");
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		$test = $sut->accessKeyLabel;
	}
}
