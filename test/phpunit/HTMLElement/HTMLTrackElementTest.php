<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLTrackElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTrackElementTest extends HTMLElementTestCase {
	public function testKind():void {
		/** @var HTMLTrackElement $sut */
		$sut = NodeTestFactory::createHTMLElement("track");
		self::assertPropertyAttributeCorrelate($sut, "kind");
	}

	public function testSrc():void {
		/** @var HTMLTrackElement $sut */
		$sut = NodeTestFactory::createHTMLElement("track");
		self::assertPropertyAttributeCorrelate($sut, "src");
	}

	public function testSrclang():void {
		/** @var HTMLTrackElement $sut */
		$sut = NodeTestFactory::createHTMLElement("track");
		self::assertPropertyAttributeCorrelate($sut, "srclang");
	}

	public function testLabel():void {
		/** @var HTMLTrackElement $sut */
		$sut = NodeTestFactory::createHTMLElement("track");
		self::assertPropertyAttributeCorrelate($sut, "label");
	}

	public function testDefault():void {
		/** @var HTMLTrackElement $sut */
		$sut = NodeTestFactory::createHTMLElement("track");
		self::assertPropertyAttributeCorrelateBool($sut, "default");
	}

	public function testReadyState():void {
		/** @var HTMLTrackElement $sut */
		$sut = NodeTestFactory::createHTMLElement("track");
		self::assertSame(0, $sut->readyState);
	}
}
