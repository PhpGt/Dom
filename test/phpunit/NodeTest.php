<?php
namespace Gt\Dom\Test;

use Error;
use Gt\Dom\Element;
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
// When the fragment is the parentNode, it is not an "Element" so this should be null...
		self::assertNull($sut->parentElement);
		$parent->appendChild($fragment);
// ... but when the fragment is added, the parent is not the Element node.
		self::assertSame($parent, $sut->parentElement);
	}

	public function testCloneNode():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = "<p><a href='https://phpunit.de'>PHPUnit is amazing!</a>";
		/** @var Element $clone */
		$clone = $sut->cloneNode();
		self::assertNotSame($sut, $clone);
		self::assertEquals("EXAMPLE", $clone->tagName);
		self::assertCount(0, $clone->childNodes);
	}

	public function testCloneNodeDeep():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = "<p><a href='https://phpunit.de'>PHPUnit is amazing!</a>";
		/** @var Element $clone */
		$clone = $sut->cloneNode(true);
		self::assertNotSame($sut, $clone);
		self::assertStringContainsString(
			"PHPUnit is amazing!",
			$clone->innerHTML
		);
		self::assertSame($sut->innerHTML, $clone->innerHTML);
	}

	public function testCompareDocumentPostitionNowhere():void {
		$sut = NodeTestFactory::createNode("example");
		$anotherNodeInAnotherDoc = NodeTestFactory::createNode("other");
		self::assertGreaterThan(
			0,
			Node::DOCUMENT_POSITION_DISCONNECTED,
			$sut->compareDocumentPosition($anotherNodeInAnotherDoc)
		);
	}

	public function testCompareDocumentPositionPreceding():void {
		$sut = NodeTestFactory::createNode("example");
		$root = NodeTestFactory::createNode("root", $sut->ownerDocument);
		$compareTo = NodeTestFactory::createNode("compare-to", $sut->ownerDocument);

		$sut->ownerDocument->appendChild($root);
		$root->appendChild($sut);
		$root->appendChild($compareTo);

		self::assertGreaterThan(
			0,
			$sut->compareDocumentPosition($compareTo)
			& Node::DOCUMENT_POSITION_FOLLOWING
		);
		self::assertGreaterThan(
			0,
			$compareTo->compareDocumentPosition($sut)
			& Node::DOCUMENT_POSITION_PRECEDING
		);
		self::assertEquals(
			0,
			$sut->compareDocumentPosition($compareTo)
			& Node::DOCUMENT_POSITION_DISCONNECTED
		);
		self::assertEquals(
			0,
			$compareTo->compareDocumentPosition($sut)
			& Node::DOCUMENT_POSITION_DISCONNECTED
		);
	}

	public function testCompareDocumentPositionFollowing():void {
		$sut = NodeTestFactory::createNode("example");
		$root = NodeTestFactory::createNode("root", $sut->ownerDocument);
		$compareTo = NodeTestFactory::createNode("compare-to", $sut->ownerDocument);

		$sut->ownerDocument->appendChild($root);
		$root->appendChild($compareTo);
		$root->appendChild($sut);

		self::assertGreaterThan(
			0,
			$sut->compareDocumentPosition($compareTo)
			& Node::DOCUMENT_POSITION_PRECEDING
		);
		self::assertGreaterThan(
			0,
			$compareTo->compareDocumentPosition($sut)
			& Node::DOCUMENT_POSITION_FOLLOWING
		);
		self::assertEquals(
			0,
			$sut->compareDocumentPosition($compareTo)
			& Node::DOCUMENT_POSITION_DISCONNECTED
		);
		self::assertEquals(
			0,
			$compareTo->compareDocumentPosition($sut)
			& Node::DOCUMENT_POSITION_DISCONNECTED
		);
	}

	public function testCompareDocumentPositionContainedBy():void {
		$sut = NodeTestFactory::createNode("example");
		$root = NodeTestFactory::createNode("root", $sut->ownerDocument);
		$compareTo = NodeTestFactory::createNode("compare-to", $sut->ownerDocument);

		$sut->ownerDocument->appendChild($root);
		$root->appendChild($sut);
		$sut->appendChild($compareTo);

		self::assertGreaterThan(
			0,
			$sut->compareDocumentPosition($compareTo)
			& Node::DOCUMENT_POSITION_CONTAINED_BY
		);
		self::assertEquals(
			0,
			$sut->compareDocumentPosition($compareTo)
			& Node::DOCUMENT_POSITION_CONTAINS
		);
	}

	public function testCompareDocumentPositionContainedByFlipped():void {
		$sut = NodeTestFactory::createNode("example");
		$root = NodeTestFactory::createNode("root", $sut->ownerDocument);
		$compareTo = NodeTestFactory::createNode("compare-to", $sut->ownerDocument);

		$sut->ownerDocument->appendChild($root);
		$root->appendChild($compareTo);
		$compareTo->appendChild($sut);

		self::assertGreaterThan(
			0,
			$sut->compareDocumentPosition($compareTo)
			& Node::DOCUMENT_POSITION_CONTAINS
		);
		self::assertEquals(
			0,
			$sut->compareDocumentPosition($compareTo)
			& Node::DOCUMENT_POSITION_CONTAINED_BY
		);
	}
}
