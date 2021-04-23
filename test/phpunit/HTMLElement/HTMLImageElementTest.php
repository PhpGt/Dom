<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\HTMLElement\HTMLImageElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLImageElementTest extends HTMLElementTestCase {
	public function testAlt():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertPropertyAttributeCorrelate($sut, "alt");
	}

	public function testComplete():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertFalse($sut->complete);
	}

	public function testCrossOrigin():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertPropertyAttributeCorrelate($sut, "crossorigin", "crossOrigin");
	}

	public function testCurrentSrc():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$test = $sut->currentSrc;
	}

	public function testDecoding():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertPropertyAttributeCorrelate($sut, "decoding");
	}

	public function testHeight():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertPropertyAttributeCorrelateNullableInt($sut, "height");
	}

	public function testIsMap():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertPropertyAttributeCorrelateBool($sut, "ismap", "isMap");
	}

	public function testLoading():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertPropertyAttributeCorrelate($sut, "loading");
	}

	public function testNaturalHeight():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertEquals(0, $sut->naturalHeight);
	}

	public function testNaturalWidth():void {
		/** @var HTMLImageElement $sut */
		$sut = NodeTestFactory::createHTMLElement("img");
		self::assertEquals(0, $sut->naturalHeight);
	}
}
