<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLDetailsElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLDetailsElementTest extends HTMLElementTestCase {
	public function testOpenDefault():void {
		/** @var HTMLDetailsElement $sut */
		$sut = NodeTestFactory::createHTMLElement("details");
		self::assertFalse($sut->open);
	}

	public function testOpen():void {
		/** @var HTMLDetailsElement $sut */
		$sut = NodeTestFactory::createHTMLElement("details");
		$sut->open = true;
		self::assertTrue($sut->open);
		self::assertTrue($sut->hasAttribute("open"));

		$sut->open = false;
		self::assertFalse($sut->open);
		self::assertFalse($sut->hasAttribute("open"));
	}
}
