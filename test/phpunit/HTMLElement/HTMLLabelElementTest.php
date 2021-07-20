<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLInputElement;
use Gt\Dom\HTMLElement\HTMLLabelElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLLabelElementTest extends HTMLElementTestCase {
	public function testControlNone():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		self::assertNull($sut->control);
	}

	public function testControlChild():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		$input = $sut->ownerDocument->createElement("input");
		$sut->appendChild($sut->ownerDocument->createElement("div"));
		$sut->appendChild($input);
		self::assertSame($input, $sut->control);
	}

	public function testControlFor():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		$sut->htmlFor = "example";
		$input = $sut->ownerDocument->createElement("input");
		$input->id = "example";
		$sut->ownerDocument->body->append($sut, $input);
		self::assertSame($input, $sut->control);
	}

	public function testFormNone():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		self::assertNull($sut->form);
	}

	public function testFormParent():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		$form = $sut->ownerDocument->createElement("form");
		$form->appendChild($sut);
		self::assertSame($form, $sut->form);
	}

	public function testFormForInput():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		$sut->htmlFor = "example";
		$input = $sut->ownerDocument->createElement("input");
		$input->id = "example";
		$form = $sut->ownerDocument->createElement("form");
		$form->appendChild($input);
		$sut->ownerDocument->body->append($sut, $form);

		self::assertSame($form, $sut->form);
	}

	public function testFor():void {
		/** @var HTMLLabelElement $sut */
		$sut = NodeTestFactory::createHTMLElement("label");
		self::assertPropertyAttributeCorrelate($sut, "for", "htmlFor");
	}
}
