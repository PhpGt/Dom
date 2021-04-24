<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLModElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLModElementTest extends HTMLElementTestCase {
	public function testCorrectTypes():void {
		self::assertInstanceOf(
			HTMLModElement::class,
			NodeTestFactory::createHTMLElement("del")
		);
		self::assertInstanceOf(
			HTMLModElement::class,
			NodeTestFactory::createHTMLElement("ins")
		);
	}
}
