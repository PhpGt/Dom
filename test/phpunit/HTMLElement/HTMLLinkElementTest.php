<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLLinkElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLLinkElementTest extends HTMLElementTestCase {
	public function testAs():void {
		/** @var HTMLLinkElement $sut */
		$sut = NodeTestFactory::createHTMLElement("link");
		self::assertPropertyAttributeCorrelate($sut, "as");
	}

	public function testDisabled():void {
		/** @var HTMLLinkElement $sut */
		$sut = NodeTestFactory::createHTMLElement("link");
		self::assertPropertyAttributeCorrelateBool($sut, "disabled");
	}

	public function testHref():void {
		/** @var HTMLLinkElement $sut */
		$sut = NodeTestFactory::createHTMLElement("link");
		self::assertPropertyAttributeCorrelate($sut, "href");
	}

	public function testHreflang():void {
		/** @var HTMLLinkElement $sut */
		$sut = NodeTestFactory::createHTMLElement("link");
		self::assertPropertyAttributeCorrelate($sut, "hreflang");
	}
}
