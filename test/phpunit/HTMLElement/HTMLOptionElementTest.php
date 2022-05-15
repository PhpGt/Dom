<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLOptionElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLOptionElementTest extends HTMLElementTestCase {
//	public function testDefaultSelected():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertPropertyAttributeCorrelateBool($sut, "selected", "defaultSelected");
//	}
//
//	public function testDisabled():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertPropertyAttributeCorrelateBool($sut, "disabled");
//	}
//
//	public function testFormNone():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertNull($sut->form);
//	}
//
//	public function testFormParent():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		$form = $sut->ownerDocument->createElement("form");
//		$form->appendChild($sut);
//		self::assertSame($form, $sut->form);
//	}
//
//	public function testIndex():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertSame(0, $sut->index);
//		$select = $sut->ownerDocument->createElement("select");
//		$select->appendChild($sut);
//		self::assertSame(0, $sut->index);
//
//		for($i = 0; $i < 10; $i++) {
//			$select->insertBefore($sut->cloneNode(), $sut);
//			self::assertSame($i + 1, $sut->index);
//		}
//	}
//
//	public function testLabelNone():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertSame("", $sut->label);
//		$sut->textContent = "test";
//		self::assertSame("test", $sut->label);
//	}
//
//	public function testLabel():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertPropertyAttributeCorrelate($sut, "label");
//	}
//
//	public function testSelected():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertPropertyAttributeCorrelateBool($sut, "selected");
//	}
//
//	public function testText():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertSame("", $sut->text);
//		for($i = 0; $i < 10; $i++) {
//			$text = uniqid();
//			$sut->text = $text;
//			self::assertEquals($text, $sut->textContent);
//		}
//
//		for($i = 0; $i < 10; $i++) {
//			$text = uniqid();
//			$sut->textContent = $text;
//			self::assertEquals($text, $sut->text);
//		}
//	}
//
//	public function testValueNone():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertSame("", $sut->value);
//		$sut->textContent = "test";
//		self::assertSame("test", $sut->value);
//	}
//
//	public function testValue():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		self::assertPropertyAttributeCorrelate($sut, "value");
//	}
//
//	public function testValue_textContentRelationship():void {
//		/** @var HTMLOptionElement $sut */
//		$sut = NodeTestFactory::createHTMLElement("option");
//		$sut->textContent = "Test";
//		self::assertSame("Test", $sut->value);
//
//		$sut->value = "123";
//		self::assertEquals("123", $sut->value);
//		self::assertSame("Test", $sut->textContent);
//	}
}
