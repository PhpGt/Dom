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

	public function testSelectedOptionsNone():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		self::assertEmpty($sut->selectedOptions);
		self::assertCount(0, $sut->selectedOptions);
	}

	public function testSelectedOptionsSingular():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");

		for($i = 0; $i < 10; $i++) {
			/** @var HTMLOptionElement $option */
			$option = $sut->ownerDocument->createElement("option");
			$sut->appendChild($option);
			$option->selected = true;
		}

		self::assertCount(1, $sut->selectedOptions);
	}

	public function testSelectedOptionsMultiple():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		$sut->multiple = true;

		for($i = 0; $i < 10; $i++) {
			/** @var HTMLOptionElement $option */
			$option = $sut->ownerDocument->createElement("option");
			$sut->appendChild($option);
			$option->selected = true;
		}

		self::assertCount($i, $sut->selectedOptions);
	}

	public function testSize():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		self::assertPropertyAttributeCorrelateNumber($sut, "?int:1", "size");
		$sut->multiple = true;
		$sut->removeAttribute("size");
		self::assertPropertyAttributeCorrelateNumber($sut, "?int:4", "size");
	}

	public function testValue_noValueAttribute():void {
		/** @var HTMLSelectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("select");
		$testValues = [
			"One",
			"Two",
			"Three",
		];
		foreach($testValues as $testValue) {
			$option = $sut->ownerDocument->createElement("option");
			$option->textContent = $testValue;
			$sut->appendChild($option);
		}

		$secondOption = $sut->options[1];
		$secondOption->selected = true;

		self::assertSame("Two", $sut->value);
	}
}
