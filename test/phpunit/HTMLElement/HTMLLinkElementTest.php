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

	public function testMedia():void {
		/** @var HTMLLinkElement $sut */
		$sut = NodeTestFactory::createHTMLElement("link");
		self::assertPropertyAttributeCorrelate($sut, "media");
	}

	public function testReferrerPolicy():void {
		/** @var HTMLLinkElement $sut */
		$sut = NodeTestFactory::createHTMLElement("link");
		self::assertPropertyAttributeCorrelate($sut, "referrerpolicy", "referrerPolicy");
	}

	public function testRel():void {
		/** @var HTMLLinkElement $sut */
		$sut = NodeTestFactory::createHTMLElement("link");
		self::assertPropertyAttributeCorrelate($sut, "rel");
	}

	public function testRelList():void {
		/** @var HTMLLinkElement $sut */
		$sut = NodeTestFactory::createHTMLElement("link");
		$sut->rel = "one";
		$relList = $sut->relList;
		self::assertCount(1, $relList);
		self::assertEquals("one", $relList->item(0));
		$sut->rel .= " two";
		self::assertCount(2, $relList);
		self::assertEquals("one", $relList->item(0));
		self::assertEquals("two", $relList->item(1));
		$relList->value = "three four";
		self::assertEquals("three four", $sut->rel);
	}
}
