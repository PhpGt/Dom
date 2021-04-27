<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLOptionElement;
use Gt\Dom\HTMLElement\HTMLSelectElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLSelectElementTest extends HTMLElementTestCase {
	public function testLengthEmpty():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		self::assertEquals(0, $sut->length);
	}

	public function testLength():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");

		for($i = 0; $i < 10; $i++) {
			$option = $sut->ownerDocument->createElement("option");
			$sut->appendChild($option);
			self::assertEquals($i + 1, $sut->length);
		}
	}

	public function testMultiple():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		self::assertPropertyAttributeCorrelateBool($sut, "multiple");
	}

	public function testOptionsEmpty():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		self::assertEmpty($sut->options);
		self::assertCount(0, $sut->options);
	}

	public function testOptions():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");

		for($i = 0; $i < 10; $i++) {
			$option = $sut->ownerDocument->createElement("option");
			$sut->appendChild($option);
			self::assertCount($i + 1, $sut->options);
		}
	}

	public function testSelectedIndexNone():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		self::assertSame(-1, $sut->selectedIndex);
	}

	public function testSelectedIndex():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		$optionArray = [];

		for($i = 0; $i < 10; $i++) {
			$option = $sut->ownerDocument->createElement("option");
			$sut->appendChild($option);
			array_push($optionArray, $option);
		}

		for($i = 0; $i < 10; $i++) {
			$randomOptionIndex = array_rand($optionArray);
			/** @var HTMLOptionElement $optionToSelect */
			$optionToSelect = $optionArray[$randomOptionIndex];
			$optionToSelect->selected = true;
			self::assertSame($randomOptionIndex, $sut->selectedIndex);
		}

		$sut->selectedIndex = -1;
		foreach($optionArray as $option) {
			/** @var HTMLOptionElement $option */
			self::assertFalse($option->hasAttribute("selected"));
		}

		for($i = 0; $i < 10; $i++) {
			$randomOptionIndex = array_rand($optionArray);
			/** @var HTMLOptionElement $optionToSelect */
			$optionToSelect = $optionArray[$randomOptionIndex];
			$sut->selectedIndex = $randomOptionIndex;
			self::assertSame($optionToSelect, $optionArray[$randomOptionIndex]);
		}
	}
}
