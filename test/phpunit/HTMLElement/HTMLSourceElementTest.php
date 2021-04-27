<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLSourceElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLSourceElementTest extends HTMLElementTestCase {
	public function testMedia():void {
		/** @var HTMLSourceElement $sut */
		$sut = NodeTestFactory::createHTMLElement("source");
		self::assertPropertyAttributeCorrelate($sut, "media");
	}

	public function testSizes():void {
		/** @var HTMLSourceElement $sut */
		$sut = NodeTestFactory::createHTMLElement("source");
		self::assertPropertyAttributeCorrelate($sut, "sizes");
	}
}
