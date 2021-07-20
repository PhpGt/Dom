<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLCollection;
use Gt\Dom\HTMLElement\HTMLDataListElement;
use Gt\Dom\HTMLElement\HTMLOptionElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLDataListElementTest extends HTMLElementTestCase {
	public function testOptionsNone():void {
		/** @var HTMLDataListElement $sut */
		$sut = NodeTestFactory::createHTMLElement("datalist");
		$options = $sut->options;
		self::assertInstanceOf(HTMLCollection::class, $options);
		self::assertCount(0, $options);
	}

	public function testOptions():void {
		/** @var HTMLDataListElement $sut */
		$sut = NodeTestFactory::createHTMLElement("datalist");
		$options = $sut->options;

		$appendedOptions = [];
		for($i = 1; $i <= 10; $i++) {
			/** @var HTMLOptionElement $option */
			$option = $sut->ownerDocument->createElement("option");
			$option->textContent = "Option $i";
			$option->value = (string)$i;
			$sut->appendChild($option);
			array_push($appendedOptions, $option);
		}

		self::assertCount(10, $options);

		foreach($options as $i => $option) {
			self::assertSame($option, $appendedOptions[$i]);
		}
	}
}
