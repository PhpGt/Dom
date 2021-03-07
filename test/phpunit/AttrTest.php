<?php
namespace Gt\Dom\Test;

use Gt\Dom\Attr;
use Gt\Dom\Document;
use Gt\Dom\Element;
use PHPUnit\Framework\TestCase;

class AttrTest extends TestCase {
	public function testPrefixNoNamespace():void {
		$document = new Document();
		$root = $document->createElement("root");
		$root->innerHTML = "<example abc:example='123'></example>";
		$document->appendChild($root);
		/** @var Element $node */
		$node = $document->documentElement->childNodes[0];
		/** @var Attr $sut */
		$sut = $node->attributes[0];
		self::assertEquals("", $sut->prefix);
		self::assertEquals("abc:example", $sut->name);
	}

	public function testOwnerElement():void {
		$document = new Document();
		$root = $document->createElement("root");
		$document->appendChild($root);
		$sut = $document->createAttribute("example");
		$added = $root->attributes->setNamedItem($sut);
// Weird, but true to the spec: a "new" attribute should return null here.
		self::assertNull($added);
		/** @var Attr $attr */
		$attr = $root->attributes[0];
		self::assertSame($attr->ownerElement, $root);
	}

	public function testOwnerElementEmpty():void {
		$document = new Document();
		$root = $document->createElement("root");
		$document->appendChild($root);
		$sut = $document->createAttribute("example");
		self::assertNull($sut->ownerElement);
	}

	public function testSpecified():void {
		$sut = (new Document())->createAttribute("example");
// Another weird DOM quirk, but again, true to spec. Always true.
		self::assertTrue($sut->specified);
	}

	public function testValue():void {
		$sut = (new Document())->createAttribute("example");
		self::assertEquals("", $sut->value);
		$sut->value = "test";
		self::assertEquals("test", $sut->value);
	}
}
