<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLEmbedElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLEmbedElementTest extends HTMLElementTestCase {
	public function testHeight():void {
		/** @var HTMLEmbedElement $sut */
		$sut = NodeTestFactory::createHTMLElement("embed");
		self::assertPropertyAttributeCorrelate($sut, "height");
	}

	public function testSrc():void {
		/** @var HTMLEmbedElement $sut */
		$sut = NodeTestFactory::createHTMLElement("embed");
		self::assertPropertyAttributeCorrelate($sut, "src");
	}
}
