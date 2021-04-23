<?php
namespace Gt\Dom\Test\HTMLElement;

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
}
