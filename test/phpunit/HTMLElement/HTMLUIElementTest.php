<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLInputElement;
use Gt\Dom\HTMLElement\HTMLOptionElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLUIElementTest extends HTMLElementTestCase {
	public function testWillValidateDisabled():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		$sut->disabled = true;
		self::assertFalse($sut->willValidate);
	}

	public function testWillValidateHidden():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		$sut->type = "hidden";
		self::assertFalse($sut->willValidate);
	}

	public function testWillValidateWithinDataList():void {
		/** @var HTMLOptionElement $sut */
		$sut = NodeTestFactory::createHTMLElement("option");
		$dataList = $sut->ownerDocument->createElement("datalist");
		$dataList->appendChild($sut);
		self::assertFalse($sut->willValidate);
	}

	public function testWillValidateWithinSelect():void {
		/** @var HTMLOptionElement $sut */
		$sut = NodeTestFactory::createHTMLElement("option");
		$select = $sut->ownerDocument->createElement("select");
		$select->appendChild($sut);
		self::assertTrue($sut->willValidate);
	}
}
