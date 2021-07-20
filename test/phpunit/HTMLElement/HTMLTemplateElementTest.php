<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLTemplateElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLTemplateElementTest extends HTMLElementTestCase {
	public function testContent():void {
		/** @var HTMLTemplateElement $sut */
		$sut = NodeTestFactory::createHTMLElement("template");
		$sut->appendChild($sut->ownerDocument->createElement("example-element"));
		$content1 = $sut->content->cloneNode(true);
		$content2 = $sut->content->cloneNode(true);

		$content1->firstChild->textContent = "First";
		$content2->firstChild->textContent = "Second";

		$appended1 = $sut->ownerDocument->body->appendChild($content1);
		$appended2 = $sut->ownerDocument->body->appendChild($content2);

		self::assertEquals("First", $appended1->textContent);
		self::assertEquals("Second", $appended2->textContent);
	}
}
