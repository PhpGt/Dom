<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLLegendElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLLegendElementTest extends HTMLElementTestCase {
	public function testFormNone():void {
		/** @var HTMLLegendElement $sut */
		$sut = NodeTestFactory::createHTMLElement("legend");
		self::assertNull($sut->form);
	}

	public function testFormWithinForm():void {
// This should still return null, as HTMLLegendElement::form simply mimics its
// parent fieldset's form property value.
		/** @var HTMLLegendElement $sut */
		$sut = NodeTestFactory::createHTMLElement("legend");
		$form = $sut->ownerDocument->createElement("form");
		$form->appendChild($sut);
		self::assertNull($sut->form);
	}

	public function testFormWithinFieldset():void {
// This should still return null, as HTMLLegendElement::form simply mimics its
// parent fieldset's form property value.
		/** @var HTMLLegendElement $sut */
		$sut = NodeTestFactory::createHTMLElement("legend");
		$form = $sut->ownerDocument->createElement("form");
		$fieldset = $sut->ownerDocument->createElement("fieldset");
		$fieldset->appendChild($sut);
		$form->appendChild($fieldset);
		self::assertSame($form, $sut->form);
	}
}
