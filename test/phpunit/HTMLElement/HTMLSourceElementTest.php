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

	public function testSrc():void {
		/** @var HTMLSourceElement $sut */
		$sut = NodeTestFactory::createHTMLElement("source");
		self::assertPropertyAttributeCorrelate($sut, "src");
	}

	public function testSrcset():void {
		/** @var HTMLSourceElement $sut */
		$sut = NodeTestFactory::createHTMLElement("source");
		self::assertPropertyAttributeCorrelate($sut, "srcset");
	}

	public function testType():void {
		/** @var HTMLSourceElement $sut */
		$sut = NodeTestFactory::createHTMLElement("source");
		self::assertPropertyAttributeCorrelate($sut, "type");
	}
}
