<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLBaseElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLBaseElementTest extends HTMLElementTestCase {
	public function testHref():void {
		/** @var HTMLBaseElement $sut */
		$sut = NodeTestFactory::createHTMLElement("base");
		self::assertPropertyAttributeCorrelate($sut, "href");
	}

	public function testTarget():void {
		/** @var HTMLBaseElement $sut */
		$sut = NodeTestFactory::createHTMLElement("base");
		self::assertPropertyAttributeCorrelate($sut, "target");
	}
}
