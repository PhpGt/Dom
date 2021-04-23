<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\HTMLElement\HTMLInputElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLInputElementTest extends HTMLElementTestCase {
	public function testChecked():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateBool($sut, "checked");
	}

	public function testDefaultChecked():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateBool($sut, "checked", "defaultChecked");
	}

	public function testIndeterminateGet():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$value = $sut->indeterminate;
	}

	public function testIndeterminateSet():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		$sut->indeterminate = true;
	}

	public function testAlt():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelate($sut, "alt");
	}

	public function testHeight():void {
		/** @var HTMLInputElement $sut */
		$sut = NodeTestFactory::createHTMLElement("input");
		self::assertPropertyAttributeCorrelateNullableInt($sut, "height");
	}
}
