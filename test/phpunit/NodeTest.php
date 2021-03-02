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
		$node = NodeTestFactory::createNode("example");
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$node->baseURI;
	}
}
