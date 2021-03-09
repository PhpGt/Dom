<?php
namespace Gt\Dom\Test;

use Gt\Dom\Facade\TreeWalkerFactory;
use Gt\Dom\Node;
use PHPUnit\Framework\TestCase;

class TreeWalkerTest extends TestCase {
	public function testRoot():void {
		$root = self::createMock(Node::class);
		$sut = TreeWalkerFactory::create($root);
		self::assertSame($root, $sut->root);
	}
}
