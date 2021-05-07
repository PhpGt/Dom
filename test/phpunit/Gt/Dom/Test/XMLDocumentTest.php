<?php
namespace Gt\Dom\Test;

use Gt\Dom\Element;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use PHPUnit\Framework\TestCase;

class XMLDocumentTest extends TestCase {
	public function testEvaluate():void {
		$sut = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_BREAKFAST_MENU);

		$i = null;
		foreach($sut->evaluate("//food") as $i => $foodElement) {
			self::assertInstanceOf(Element::class, $foodElement);
		}

		self::assertSame(4, $i);
	}
}
