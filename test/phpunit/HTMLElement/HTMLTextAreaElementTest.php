<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLTextAreaElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTextAreaElementTest extends HTMLElementTestCase {
	public function testAutocapitalize():void {
		/** @var HTMLTextAreaElement $sut */
		$sut = NodeTestFactory::createHTMLElement("textarea");
		self::assertPropertyAttributeCorrelate($sut, "autocapitalize");
	}

	public function testCols():void {
		/** @var HTMLTextAreaElement $sut */
		$sut = NodeTestFactory::createHTMLElement("textarea");
		self::assertPropertyAttributeCorrelateNumber($sut, "int:20", "cols");
	}

	public function testDefaultValue():void {
		/** @var HTMLTextAreaElement $sut */
		$sut = NodeTestFactory::createHTMLElement("textarea");
		self::assertPropertyAttributeCorrelate($sut, "value", "defaultValue");
	}
}
