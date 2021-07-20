<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLStyleElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLStyleElementTest extends HTMLElementTestCase {
	public function testMedia():void {
		/** @var HTMLStyleElement $sut */
		$sut = NodeTestFactory::createHTMLElement("style");
		self::assertPropertyAttributeCorrelate($sut, "media");
	}

	public function testType():void {
		/** @var HTMLStyleElement $sut */
		$sut = NodeTestFactory::createHTMLElement("style");
		self::assertPropertyAttributeCorrelate($sut, "type");
	}

	public function testDisabled():void {
		/** @var HTMLStyleElement $sut */
		$sut = NodeTestFactory::createHTMLElement("style");
		self::assertPropertyAttributeCorrelateBool($sut, "disabled");
	}

	public function testSheet():void {
		/** @var HTMLStyleElement $sut */
		$sut = NodeTestFactory::createHTMLElement("style");
		self::assertNull($sut->sheet);
	}
}
