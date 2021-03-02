<?php
namespace Gt\Dom\Test;

use Error;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\Node;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use Gt\Dom\Text;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase {
	public function testCanNotConstruct():void {
		self::expectException(Error::class);
		self::expectExceptionMessage("Cannot instantiate abstract class Gt\Dom\Node");
		$className = Node::class;
		/** @phpstan-ignore-next-line */
		new $className();
	}

	public function testBaseURIClientSideOnly():void {
		$sut = NodeTestFactory::createNode("example");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->baseURI;
	}

	public function testChildNodesEmpty():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertEmpty($sut->childNodes);
		self::assertCount(0, $sut->childNodes);
	}

	public function testChildNodes():void {
		$sut = NodeTestFactory::createNode("example");
		$child = $sut->ownerDocument->createElement("example-child");
		$sut->appendChild($child);
		self::assertCount(1, $sut->childNodes);
	}

	public function testChildNodesManyLive():void {
		$sut = NodeTestFactory::createNode("example");

		$nodeList = $sut->childNodes;
		self::assertCount(0, $nodeList);

		for($i = 0; $i < 100; $i++) {
			$child = $sut->ownerDocument->createElement(
				uniqid("child-")
			);
			$sut->appendChild($child);
		}

		self::assertCount(100, $nodeList);
	}

	public function testFirstChildNone():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->firstChild);
	}

	public function testFirstChild():void {
		$sut = NodeTestFactory::createNode("example");
		$c1 = $sut->ownerDocument->createElement("child-one");
		$c2 = $sut->ownerDocument->createElement("child-two");
		$c3 = $sut->ownerDocument->createElement("child-three");
		$sut->append($c1, $c2, $c3);
		self::assertSame($c1, $sut->firstChild);
	}

	public function testLastChildNone():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->lastChild);
	}

	public function testLastChild():void {
		$sut = NodeTestFactory::createNode("example");
		$c1 = $sut->ownerDocument->createElement("child-one");
		$c2 = $sut->ownerDocument->createElement("child-two");
		$c3 = $sut->ownerDocument->createElement("child-three");
		$sut->append($c1, $c2, $c3);
		self::assertSame($c3, $sut->lastChild);
	}

	public function testFirstChildAfterInsertBefore():void {
		$sut = NodeTestFactory::createNode("example");
		$c1 = $sut->ownerDocument->createElement("child-one");
		$c2 = $sut->ownerDocument->createElement("child-two");
		$c3 = $sut->ownerDocument->createElement("child-three");
		$sut->append($c1, $c2);
		$sut->insertBefore($c3, $c1);
		self::assertSame($c3, $sut->firstChild);
	}

	public function testIsConnected():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertFalse($sut->isConnected);
		$sut->ownerDocument->append($sut);
		self::assertTrue($sut->isConnected);
	}

	public function testNextSiblingNone():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->nextSibling);
	}

	public function testNextSibling():void {
		$parent = NodeTestFactory::createNode("parent");
		$c1 = NodeTestFactory::createNode("child", $parent->ownerDocument);
		$sut = NodeTestFactory::createNode("child", $parent->ownerDocument);
		$c2 = NodeTestFactory::createNode("child", $parent->ownerDocument);

		$parent->append($c1, $sut, $c2);
		self::assertSame($c2, $sut->nextSibling);
	}

	public function testPreviousSiblingNone():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->previousSibling);
	}

	public function testPreviousSibling():void {
		$parent = NodeTestFactory::createNode("parent");
		$c1 = NodeTestFactory::createNode("child", $parent->ownerDocument);
		$sut = NodeTestFactory::createNode("child", $parent->ownerDocument);
		$c2 = NodeTestFactory::createNode("child", $parent->ownerDocument);

		$parent->append($c1, $sut, $c2);
		self::assertSame($c1, $sut->previousSibling);
	}

	public function testNodeName():void {
// TODO: Test other types of nodes (Attr, CDATASection, Comment, Document,
// DocumentFragment, DocumentType, Notation, ProcessingInstruction, Text) as
// each node type has a different expectation for this value.
		$sut = NodeTestFactory::createNode("example");
		self::assertEquals("example", $sut->nodeName);
	}

	public function testNodeType():void {
// TODO: Test the other types of nodes, make sure they return the expected
// values in accordance to the Node::TYPE* constants.
		$sut = NodeTestFactory::createNode("example");
		self::assertEquals(
			Node::TYPE_ELEMENT_NODE,
			$sut->nodeType
		);
	}

	public function testNodeValueGetNone():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->nodeValue);
	}

	public function testNodeValueGetEmptyWithChildTextContent():void {
		$message = "This is a test message.";
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = $message;
		self::assertNull($sut->nodeValue);
		$textNode = $sut->childNodes[0];
		self::assertInstanceOf(Text::class, $textNode);
		self::assertEquals($message, $textNode->nodeValue);
	}

	public function testNodeValueSetNoEffectOnElement():void {
// TODO: Test nodeValue on other types of node.
		$sut = NodeTestFactory::createNode("example");
		$sut->nodeValue = "Example value.";
		self::assertNull($sut->nodeValue);
	}

	public function testOwnerDocument():void {
		$sut = NodeTestFactory::createNode("example");
		$doc = $sut->ownerDocument;
		$docDoc = $doc->ownerDocument;
		self::assertSame($doc, $docDoc);
	}

	public function testParentElementNone():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->parentElement);
	}

	public function testParentElement():void {
		$sut = NodeTestFactory::createNode("example");
		$parent = NodeTestFactory::createNode("parent", $sut->ownerDocument);
		$parent->appendChild($sut);
		self::assertSame($parent, $sut->parentElement);
	}

	public function testParentElementNode():void {
		$sut = NodeTestFactory::createNode("example");
		$fragment = $sut->ownerDocument->createDocumentFragment();
		$fragment->appendChild($sut);
		$parent = NodeTestFactory::createNode("parent", $sut->ownerDocument);
		self::assertNull($sut->parentElement);
		$parent->appendChild($fragment);
		self::assertSame($parent, $sut->parentElement);
	}
}
