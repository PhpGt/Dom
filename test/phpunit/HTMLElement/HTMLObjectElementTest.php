<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\HTMLElement\HTMLObjectElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLObjectElementTest extends HTMLElementTestCase {
	public function testContentDocument():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertNull($sut->contentDocument);
	}

	public function testContentWindow():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertNull($sut->contentWindow);
	}

	public function testData():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertPropertyAttributeCorrelate($sut, "data");
	}

	public function testFormNone():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertNull($sut->form);
	}

	public function testForm():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		$form = $sut->ownerDocument->createElement("form");
		$form->appendChild($sut);
		self::assertSame($form, $sut->form);
	}

	public function testHeight():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertPropertyAttributeCorrelate($sut, "height");
	}

	public function testName():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertPropertyAttributeCorrelate($sut, "name");
	}

	public function testType():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertPropertyAttributeCorrelate($sut, "type");
	}

	public function testTypeMustMatch():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertPropertyAttributeCorrelateBool($sut, "typemustmatch", "typeMustMatch");
	}

	public function testUseMap():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertPropertyAttributeCorrelate($sut, "usemap", "useMap");
	}

	public function testValidationMessage():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::assertSame("", $sut->validationMessage);
	}

	public function testValidity():void {
		/** @var HTMLObjectElement $sut */
		$sut = NodeTestFactory::createHTMLElement("object");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$value = $sut->validity;
	}
}
