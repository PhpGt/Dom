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
}
