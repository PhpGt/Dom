<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLButtonElement;
use Gt\Dom\HTMLElement\HTMLLabelElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLButtonElementTest extends HTMLElementTestCase {
	public function testAutofocus():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		self::assertPropertyAttributeCorrelateBool($sut, "autofocus");
	}

	public function testDisabled():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		self::assertPropertyAttributeCorrelateBool($sut, "disabled");
	}

	public function testFormNone():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		self::assertNull($sut->form);
	}

	public function testForm():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		$form = $sut->ownerDocument->createElement("form");
		$form->appendChild($sut);
		self::assertSame($form, $sut->form);
	}

	public function testFormNested():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		$form = $sut->ownerDocument->createElement("form");
		$child1 = $sut->ownerDocument->createElement("div");
		$child2 = $sut->ownerDocument->createElement("div");
		$child3 = $sut->ownerDocument->createElement("div");
		$form->appendChild($child1);
		$child1->appendChild($child2);
		$child2->appendChild($child3);
		$child3->appendChild($sut);
		self::assertSame($form, $sut->form);
	}

	public function testLabels():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		$sut->id = "sut";
		$parent = $sut->ownerDocument->createElement("div");
		$sut->ownerDocument->body->appendChild($parent);
		/** @var HTMLLabelElement $label1 */
		$label1 = $sut->ownerDocument->createElement("label");
		/** @var HTMLLabelElement $label2 */
		$label2 = $sut->ownerDocument->createElement("label");
		$parent->append($label1, $sut, $label2);
		$label1->htmlFor = "sut";
		$label2->htmlFor = "sut";

		$labels = $sut->labels;
		self::assertSame($label1, $labels->item(0));
		self::assertSame($label2, $labels->item(1));
	}

	public function testName():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		self::assertPropertyAttributeCorrelate($sut, "name");
	}

	public function testReadOnly():void {
		/** @var HTMLButtonElement $sut */
		$sut = NodeTestFactory::createHTMLElement("button");
		self::assertPropertyAttributeCorrelateBool($sut, "readonly", "readOnly");
	}
}
