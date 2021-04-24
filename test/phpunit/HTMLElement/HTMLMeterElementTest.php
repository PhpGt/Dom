<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLMeterElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLMeterElementTest extends HTMLElementTestCase {
	public function testHigh():void {
		/** @var HTMLMeterElement $sut */
		$sut = NodeTestFactory::createHTMLElement("meter");
		self::assertPropertyAttributeCorrelateNumber($sut, "?float", "high");
	}
}
