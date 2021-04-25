<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLProgressElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLProgressElementTest extends HTMLElementTestCase {
	public function testMax():void {
		/** @var HTMLProgressElement $sut */
		$sut = NodeTestFactory::createHTMLElement("progress");
		self::assertPropertyAttributeCorrelateNumber($sut, "?float", "max");
	}
}
