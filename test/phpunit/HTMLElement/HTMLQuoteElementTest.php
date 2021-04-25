<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLQuoteElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLQuoteElementTest extends HTMLElementTestCase {
	public function testCite():void {
		/** @var HTMLQuoteElement $sut */
		$sut = NodeTestFactory::createHTMLElement("blockquote");
		self::assertPropertyAttributeCorrelate($sut, "cite");
	}
}
