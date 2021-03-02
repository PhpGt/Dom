<?php
namespace Gt\Dom\Test;

use Error;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\Node;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
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
}
