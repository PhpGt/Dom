<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLMapElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLMapElementTest extends HTMLElementTestCase {
	public function testName():void {
		/** @var HTMLMapElement $sut */
		$sut = NodeTestFactory::createHTMLElement("map");
		self::assertPropertyAttributeCorrelate($sut, "name");
	}
}
