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

	public function testChildElementCountNonElement():void {
		$sut = NodeTestFactory::createNode("example");
		$count = rand(50, 500);
		$textCount = 0;
		for($i = 0; $i < $count; $i++) {
			if($i % 25 === 0) {
				$child = $sut->ownerDocument->createTextNode("Some text");
				$textCount++;
			}
			else {
				$child = $sut->ownerDocument->createElement("child");
			}
			$sut->appendChild($child);
		}

		self::assertEquals($count - $textCount, $sut->childElementCount);
	}

	public function testChildrenEmpty():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertCount(0, $sut->children);
		self::assertEquals(0, $sut->children->length);
	}

	public function testChildren():void {
		$sut = NodeTestFactory::createNode("example");

		$count = rand(50, 500);
		for($i = 0; $i < $count; $i++) {
			$child = $sut->ownerDocument->createElement("child");
			$sut->appendChild($child);
		}

		self::assertCount($count, $sut->children);
		self::assertEquals($count, $sut->children->length);
	}

	public function testChildrenNonElement():void {
		$sut = NodeTestFactory::createNode("example");
		$count = rand(50, 500);
		$textCount = 0;
		for($i = 0; $i < $count; $i++) {
			if($i % 25 === 0) {
				$child = $sut->ownerDocument->createTextNode("Some text");
				$textCount++;
			}
			else {
				$child = $sut->ownerDocument->createElement("child");
			}
			$sut->appendChild($child);
		}

		self::assertEquals($count - $textCount, $sut->children->length);
		self::assertCount($count - $textCount, $sut->children);
	}
}
