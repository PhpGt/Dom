<?php
namespace Gt\Dom\Test;

use Gt\Dom\Facade\NodeListFactory;
use Gt\Dom\Node;
use PHPUnit\Framework\TestCase;

class NodeListTest extends TestCase {
	public function testLengthEmpty():void {
		$sut = NodeListFactory::create();
		self::assertEquals(0, $sut->length);
		self::assertCount(0, $sut);
	}

	public function testLength():void {
		$node1 = self::createMock(Node::class);
		$node2 = self::createMock(Node::class);
		$node3 = self::createMock(Node::class);
		$sut = NodeListFactory::create($node1, $node2, $node3);
		self::assertEquals(3, $sut->length);
	}
}
