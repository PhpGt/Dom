<?php
namespace Gt\Dom\Test;

use Gt\Dom\Test\TestFactory\NodeTestFactory;
use PHPUnit\Framework\TestCase;

class ParentNodeTest extends TestCase {
	public function testChildElementCountEmpty():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertEquals(0, $sut->childElementCount);
	}

	public function testChildElementCount():void {
		$sut = NodeTestFactory::createNode("example");
		$count = rand(50, 500);
		for($i = 0; $i < $count; $i++) {
			$child = $sut->ownerDocument->createElement("child");
			$sut->appendChild($child);
		}

		self::assertEquals($count, $sut->childElementCount);
	}
}
