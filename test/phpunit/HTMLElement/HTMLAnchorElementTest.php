<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLAnchorElementTest extends HTMLElementTestCase {
	public function testHrefLang():void {
		$sut = NodeTestFactory::createHTMLElement("a");
		self::assertPropertyAttributeCorrelate($sut, "hreflang");
	}
}
