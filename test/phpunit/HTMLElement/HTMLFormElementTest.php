<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLFormElement;
use Gt\Dom\HTMLFormControlsCollection;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLFormElementTest extends HTMLElementTestCase {
	public function testElementsEmpty():void {
		/** @var HTMLFormElement $sut */
		$sut = NodeTestFactory::createHTMLElement("form");
		$elements = $sut->elements;
		self::assertInstanceOf(HTMLFormControlsCollection::class, $elements);
		self::assertCount(0, $elements);
	}

	public function testElements():void {
		/** @var HTMLFormElement $sut */
		$sut = NodeTestFactory::createHTMLElement("form");
		$elements = $sut->elements;
		$button = $sut->ownerDocument->createElement("button");
		$input = $sut->ownerDocument->createElement("input");
		$div = $sut->ownerDocument->createElement("div");
		$select = $sut->ownerDocument->createElement("select");
		$sut->append($button, $input, $div, $select);
		self::assertCount(3, $elements);
	}

	public function testLengthEmpty():void {
		/** @var HTMLFormElement $sut */
		$sut = NodeTestFactory::createHTMLElement("form");
		self::assertEquals(0, $sut->length);
		self::assertCount(0, $sut);
	}
}
