<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\HTMLElement\HTMLIFrameElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLIFrameElementTest extends HTMLElementTestCase {
	public function testGetContentDocument():void {
		/** @var HTMLIFrameElement $sut */
		$sut = NodeTestFactory::createHTMLElement("iframe");
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$value = $sut->contentDocument;
	}

	public function testGetContentWindow():void {
		/** @var HTMLIFrameElement $sut */
		$sut = NodeTestFactory::createHTMLElement("iframe");
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$value = $sut->contentWindow;
	}

	public function testHeight():void {
		/** @var HTMLIFrameElement $sut */
		$sut = NodeTestFactory::createHTMLElement("iframe");
		self::assertPropertyAttributeCorrelate($sut, "height");
	}

	public function testName():void {
		/** @var HTMLIFrameElement $sut */
		$sut = NodeTestFactory::createHTMLElement("iframe");
		self::assertPropertyAttributeCorrelate($sut, "name");
	}

	public function testReferrerPolicy():void {
		/** @var HTMLIFrameElement $sut */
		$sut = NodeTestFactory::createHTMLElement("iframe");
		self::assertPropertyAttributeCorrelate($sut, "referrerpolicy", "referrerPolicy");
	}

	public function testSrc():void {
		/** @var HTMLIFrameElement $sut */
		$sut = NodeTestFactory::createHTMLElement("iframe");
		self::assertPropertyAttributeCorrelate($sut, "src");
	}
}
