<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLMetaElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLMetaElementTest extends HTMLElementTestCase {
	public function testContent():void {
		/** @var HTMLMetaElement $sut */
		$sut = NodeTestFactory::createHTMLElement("meta");
		self::assertPropertyAttributeCorrelate($sut, "content");
	}

	public function testHttpEquiv():void {
		/** @var HTMLMetaElement $sut */
		$sut = NodeTestFactory::createHTMLElement("meta");
		self::assertPropertyAttributeCorrelate($sut, "http-equiv", "httpEquiv");
	}

	public function testName():void {
		/** @var HTMLMetaElement $sut */
		$sut = NodeTestFactory::createHTMLElement("meta");
		self::assertPropertyAttributeCorrelate($sut, "name");
	}
}
