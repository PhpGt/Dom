<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\EnumeratedValueException;
use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\Test\TestFactory\HTMLElementTestFactory;
use PHPUnit\Framework\TestCase;

class HTMLElementTest extends TestCase {
	public function testAccessKeyNone():void {
		$sut = HTMLElementTestFactory::create("div");
		self::assertEquals("", $sut->accessKey);
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

	public function testContentEditableInherit():void {
		$sut = HTMLElementTestFactory::create("div");
		self::assertEquals("inherit", $sut->contentEditable);
	}

	public function testContentEditable():void {
		$sut = HTMLElementTestFactory::create("div");
		$sut->contentEditable = "true";
		self::assertEquals("true", $sut->contentEditable);
		$sut->contentEditable = "false";
		self::assertEquals("false", $sut->contentEditable);
		$sut->contentEditable = "inherit";
		self::assertEquals("inherit", $sut->contentEditable);
	}

	public function testContentEditableEnum():void {
		$sut = HTMLElementTestFactory::create("div");
		self::expectException(EnumeratedValueException::class);
		$sut->contentEditable = "truthy";
	}

	public function testIsContentEditableDefault():void {
		$sut = HTMLElementTestFactory::create("div");
		self::assertFalse($sut->isContentEditable);
	}

	public function testIsContentEditableTrueFalse():void {
		$sut = HTMLElementTestFactory::create("div");
		$sut->contentEditable = "true";
		self::assertTrue($sut->isContentEditable);
		$sut->contentEditable = "false";
		self::assertFalse($sut->isContentEditable);
	}

	public function testIsContentEditableInheritNoParent():void {
		$sut = HTMLElementTestFactory::create("div");
		$sut->contentEditable = "inherit";
		self::assertFalse($sut->isContentEditable);
	}

	public function testIsContentEditableInheritParentWithFalse():void {
		$sut = HTMLElementTestFactory::create("div");
		$sut->contentEditable = "inherit";
		$falseContentEditable = $sut->ownerDocument->createElement("div");
		$falseContentEditable->contentEditable = "false";
		$falseContentEditable->appendChild($sut);
		self::assertFalse($sut->isContentEditable);
	}

	public function testIsContentEditableInheritParentWithTrue():void {
		$sut = HTMLElementTestFactory::create("div");
		$sut->contentEditable = "inherit";
		$falseContentEditable = $sut->ownerDocument->createElement("div");
		$falseContentEditable->contentEditable = "true";
		$falseContentEditable->appendChild($sut);
		self::assertTrue($sut->isContentEditable);
	}
}
