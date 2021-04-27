<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLScriptElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLScriptElementTest extends HTMLElementTestCase {
	public function testType():void {
		/** @var HTMLScriptElement $sut */
		$sut = NodeTestFactory::createHTMLElement("script");
		self::assertPropertyAttributeCorrelate($sut, "type");
	}

	public function testSrc():void {
		/** @var HTMLScriptElement $sut */
		$sut = NodeTestFactory::createHTMLElement("script");
		self::assertPropertyAttributeCorrelate($sut, "src");
	}

	public function testAsync():void {
		/** @var HTMLScriptElement $sut */
		$sut = NodeTestFactory::createHTMLElement("script");
		self::assertPropertyAttributeCorrelateBool($sut, "async");
	}
}
