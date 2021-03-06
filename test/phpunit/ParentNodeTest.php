<?php
namespace Gt\Dom\Test;

use Gt\Dom\Element;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use Gt\Dom\Text;
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

	public function testFirstElementChildEmpty():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->firstElementChild);
	}

	public function testFirstElementChild():void {
		$sut = NodeTestFactory::createNode("example");
		$child1 = $sut->ownerDocument->createElement("child");
		$child2 = $sut->ownerDocument->createElement("child");
		$sut->append($child1, $child2);
		self::assertSame($child1, $sut->firstElementChild);
	}

	public function testFirstElementChildTextNode():void {
		$sut = NodeTestFactory::createNode("example");
		$child1 = $sut->ownerDocument->createElement("child");
		$child2 = $sut->ownerDocument->createElement("child");
		$text = $sut->ownerDocument->createTextNode("Some text");
		$sut->append($text, $child1, $child2);
		self::assertSame($child1, $sut->firstElementChild);
	}

	public function testFirstElementChildAllTextNodes():void {
		$sut = NodeTestFactory::createNode("example");
		$child1 = $sut->ownerDocument->createTextNode("Some text");
		$child2 = $sut->ownerDocument->createTextNode("Some more text");
		$sut->append($child1, $child2);
		self::assertNull($sut->firstElementChild);
	}

	public function testLastElementChildEmpty():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->lastElementChild);
	}

	public function testLastElementChild():void {
		$sut = NodeTestFactory::createNode("example");
		$child1 = $sut->ownerDocument->createElement("child");
		$child2 = $sut->ownerDocument->createElement("child");
		$sut->append($child1, $child2);
		self::assertSame($child2, $sut->lastElementChild);
	}

	public function testLastElementChildAllTextNodes():void {
		$sut = NodeTestFactory::createNode("example");
		$child1 = $sut->ownerDocument->createTextNode("Some text");
		$child2 = $sut->ownerDocument->createTextNode("Some more text");
		$sut->append($child1, $child2);
		self::assertNull($sut->lastElementChild);
	}

	public function testLastElementChildAllTextNodesAfterFirst():void {
		$sut = NodeTestFactory::createNode("example");
		$child1 = $sut->ownerDocument->createElement("child");
		$child2 = $sut->ownerDocument->createTextNode("Some text");
		$child3 = $sut->ownerDocument->createTextNode("Some more text");
		$sut->append($child1, $child2, $child3);
		self::assertSame($child1, $sut->lastElementChild);
	}

	public function testPrependString():void {
		$sut = NodeTestFactory::createNode("example");
		$child = $sut->ownerDocument->createElement("child");
		$sut->appendChild($child);
		$sut->prepend("Some text");
		self::assertInstanceOf(Text::class, $sut->firstChild);
	}

	public function testPrependNode():void {
		$sut = NodeTestFactory::createNode("example");
		$child = $sut->ownerDocument->createElement("child");
		$toPrepend = $sut->ownerDocument->createElement("prepend-me");
		$sut->appendChild($child);
		$sut->prepend($toPrepend);
		self::assertSame($toPrepend, $sut->firstChild);
	}

	public function testPrependMixed():void {
		$sut = NodeTestFactory::createNode("example");
		$child = $sut->ownerDocument->createElement("child");
		$sut->appendChild($child);

		$toPrepend = [
			$sut->ownerDocument->createElement("first-prepend"),
			$sut->ownerDocument->createElement("second-prepend"),
			"First text",
			$sut->ownerDocument->createElement("third-prepend"),
			$sut->ownerDocument->createTextNode("Second text"),
		];
		$sut->prepend(...$toPrepend);

		foreach($sut->childNodes as $i => $node) {
			if($i < count($toPrepend)) {
				$expected = $toPrepend[$i];
				if($expected instanceof Element) {
					self::assertSame($toPrepend[$i], $node);
				}
				else {
					$text = $expected;
					if($text instanceof Text) {
						$text = $text->nodeValue;
					}

					self::assertSame($text, $node->nodeValue);
				}
			}
			else {
				self::assertSame($child, $node);
			}
		}
	}

	public function testAppendElement():void {
		$sut = NodeTestFactory::createNode("example");
		$child = $sut->ownerDocument->createElement("child");
		$sut->appendChild($child);
		$toAppend = $sut->ownerDocument->createElement("to-append");
		$sut->append($toAppend);
		self::assertSame($toAppend, $sut->lastChild);
	}

	public function testAppendText():void {
		$sut = NodeTestFactory::createNode("example");
		$child = $sut->ownerDocument->createElement("child");
		$sut->append($child, "One", "Two");
		self::assertCount(3, $sut->childNodes);
		self::assertEquals("One", $sut->childNodes[1]->nodeValue);
		self::assertEquals("Two", $sut->childNodes[2]->nodeValue);
	}

	public function testReplaceChildren():void {
		$sut = NodeTestFactory::createNode("example");
		$child = $sut->ownerDocument->createElement("child");
		$sut->appendChild($child->cloneNode());
		$sut->appendChild($child->cloneNode());
		$sut->appendChild($child->cloneNode());
		self::assertCount(3, $sut->childNodes);
		$sut->replaceChildren("Hello!");
		self::assertCount(1, $sut->childNodes);
		self::assertInstanceOf(Text::class, $sut->firstChild);
		self::assertEquals("Hello!", $sut->firstChild->nodeValue);
	}

	public function testReplaceChildrenMultiple():void {
		$sut = NodeTestFactory::createNode("example");
		$child = $sut->ownerDocument->createElement("child");
		$sut->appendChild($child->cloneNode());
		$sut->appendChild($child->cloneNode());
		$sut->appendChild($child->cloneNode());
		self::assertCount(3, $sut->childNodes);
		$sut->replaceChildren(
			"Hello!",
			$sut->ownerDocument->createElement("replacer"),
			"PHPUnit!",
		);
		self::assertCount(3, $sut->childNodes);
		self::assertCount(1, $sut->children);
		self::assertEquals("Hello!", $sut->firstChild->nodeValue);
		self::assertEquals("PHPUnit!", $sut->lastChild->nodeValue);
		self::assertEquals("REPLACER", $sut->firstElementChild->tagName);
	}
}
