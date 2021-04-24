<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLInputElement;
use Gt\Dom\HTMLElement\HTMLLabelElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLLabelElementTest extends HTMLElementTestCase {
	public function testControlNone():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		self::assertNull($sut->control);
	}

	public function testControlChild():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		$input = $sut->ownerDocument->createElement("input");
		$sut->appendChild($sut->ownerDocument->createElement("div"));
		$sut->appendChild($input);
		self::assertSame($input, $sut->control);
	}

	public function testControlFor():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		$sut->htmlFor = "example";
		$input = $sut->ownerDocument->createElement("input");
		$input->id = "example";
		$sut->ownerDocument->body->append($sut, $input);
		self::assertSame($input, $sut->control);
	}
}
