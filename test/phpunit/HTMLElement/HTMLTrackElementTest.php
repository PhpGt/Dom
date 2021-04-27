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
}
