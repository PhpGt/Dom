<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLCollection;
use Gt\Dom\HTMLDocument;

class HTMLDataListElementTest extends HTMLElementTestCase {
	public function testOptionsNone():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("datalist");
		$options = $sut->options;
		self::assertInstanceOf(HTMLCollection::class, $options);
		self::assertCount(0, $options);
	}

	public function testOptions():void {
		$document = new HTMLDocument();
		$sut = $document->createElement("datalist");
		$options = $sut->options;

		$appendedOptions = [];
		for($i = 1; $i <= 10; $i++) {
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
