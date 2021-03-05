<?php
namespace Gt\Dom\Test;

use Gt\Dom\Element;
use Gt\Dom\Exception\InvalidCharacterException;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase {
	public function testIsEqualNodeDifferentTagName():void {
		$sut = NodeTestFactory::createNode("example");
		$other = $sut->ownerDocument->createElement("different");
		self::assertFalse($sut->isEqualNode($other));
	}

	public function testIsEqualNodeDifferentAttributeLength():void {
		$sut = NodeTestFactory::createNode("example");
		/** @var Element $other */
		$other = $sut->cloneNode();
		$other->setAttribute("name", "unit-test");
		self::assertFalse($sut->isEqualNode($other));
	}

	public function testIsEqualNodeDifferentAttributeContent():void {
		$sut = NodeTestFactory::createNode("example");
		/** @var Element $other */
		$other = $sut->cloneNode();
		$other->setAttribute("name", "unit-test");
		$sut->setAttribute("something", "other");
		self::assertFalse($sut->isEqualNode($other));
	}

	public function testIsEqualDifferentChildrenEqualContent():void {
		$sut = NodeTestFactory::createNode("example");
		$other = $sut->cloneNode();
		$child1 = $sut->ownerDocument->createElement("child");
		$child2 = $sut->ownerDocument->createElement("child");
		$sut->appendChild($child1);
		$other->appendChild($child2);
		self::assertTrue($sut->isEqualNode($other));
	}

	public function testIsEqualDifferentChildrenDifferentContent():void {
		$sut = NodeTestFactory::createNode("example");
		$other = $sut->cloneNode();
		$child1 = $sut->ownerDocument->createElement("child");
		$child1->innerHTML = "<p>Child 1</p>";
		$child2 = $sut->ownerDocument->createElement("child");
		$child2->innerHTML = "<p>Child 2</p>";
		$sut->appendChild($child1);
		$other->appendChild($child2);
		self::assertFalse($sut->isEqualNode($other));
	}

	public function testAttributesLive():void {
		$sut = NodeTestFactory::createNode("example");
		$attributes = $sut->attributes;
		self::assertCount(0, $attributes);
		$sut->setAttribute("name", "unti-test");
		self::assertCount(1, $attributes);
		$sut->setAttribute("framework", "PHPUnit");
		self::assertCount(2, $attributes);
		$sut->setAttribute("name", "unit-test");
		self::assertCount(2, $attributes);
	}

	public function testClassList():void {
		$sut = NodeTestFactory::createNode("example");
		$classList = $sut->classList;
		self::assertFalse($classList->contains("a-class"));
		$sut->className = "something another-thing a-class final-class";
		self::assertTrue($classList->contains("a-class"));
	}

	public function testClassName():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->className = "something another-thing a-class final-class";
		self::assertEquals(
			$sut->className,
			$sut->getAttribute("class")
		);
	}

	public function testId():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->id = "something";
		self::assertEquals(
			$sut->id,
			$sut->getAttribute("id")
		);
	}

	public function testInnerHTML():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = "<p>A paragraph</p>
		<div>A div</div>";
		self::assertEquals("A paragraph", $sut->children[0]->innerHTML);
		self::assertEquals("A div", $sut->children[1]->innerHTML);
	}

	public function testInnerHTMLReset():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = "<p>A paragraph</p>
		<div>A div</div>";
		$sut->innerHTML = "<example>An example</example><another-example>And another</another-example>";
		self::assertEquals("An example", $sut->children[0]->innerHTML);
		self::assertEquals("And another", $sut->children[1]->innerHTML);
	}

	public function testOuterHTML():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = "<p>A paragraph</p>";
		self::assertEquals(
			"<example><p>A paragraph</p></example>",
			$sut->outerHTML
		);
	}

	public function testOuterHTMLNoParent():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->outerHTML = "<not-example></not-example>";
// The original reference should not change.
		self::assertEquals("<example></example>", $sut->outerHTML);
	}

	public function testOuterHTMLSet():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->ownerDocument->appendChild($sut);
		self::assertCount(
			1,
			$sut->ownerDocument->getElementsByTagName("example")
		);

		$innerHTML = "<p>A paragraph</p>";
		$sut->outerHTML = "<changed-outer>$innerHTML</changed-outer>";
		self::assertCount(
			0,
			$sut->ownerDocument->getElementsByTagName("example")
		);
		self::assertCount(
			1,
			$sut->ownerDocument->getElementsByTagName("changed-outer")
		);
		self::assertEquals(
			"<changed-outer><p>A paragraph</p></changed-outer>",
			$sut->ownerDocument->getElementsByTagName("changed-outer")->item(0)->outerHTML
		);
	}

	public function testOuterHTMLSetMultiple():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->ownerDocument->appendChild($sut);
		self::assertCount(1, $sut->ownerDocument->getElementsByTagName("example"));
		$sut->outerHTML = "<first-outer>Example1</first-outer><second-outer>Example2</second-outer>";
		self::assertCount(0, $sut->ownerDocument->getElementsByTagName("example"));
		self::assertCount(1, $sut->ownerDocument->getElementsByTagName("first-outer"));
		self::assertCount(1, $sut->ownerDocument->getElementsByTagName("second-outer"));
	}

	public function testOuterHTMLParent():void {
		$html = "<changed-tag>Some content</changed-tag>";
		$sut = NodeTestFactory::createNode("example");
		$sut->ownerDocument->appendChild($sut);
		$sut->outerHTML = $html;
		self::assertCount(0, $sut->ownerDocument->getElementsByTagName("example"));
		self::assertCount(1, $sut->ownerDocument->getElementsByTagName("changed-tag"));
	}

	public function testChildren():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = "<p>A paragraph</p>
		<div>A div</div>";
		self::assertCount(2, $sut->children);
		self::assertEquals("A paragraph", $sut->children[0]->innerHTML);
		self::assertEquals("A div", $sut->children[1]->innerHTML);
	}

	public function testPrefix():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertEquals("", $sut->prefix);
	}

	public function testTagName():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertEquals("EXAMPLE", $sut->tagName);
		$sut = NodeTestFactory::createNode("Example");
		self::assertEquals("EXAMPLE", $sut->tagName);
	}

	public function testTagNameInvalid():void {
		self::expectException(InvalidCharacterException::class);
		NodeTestFactory::createNode("This can't be done");
	}

	public function testClosestNoMatch():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->closest("nothing"));
	}

	public function testClosestSelf():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->ownerDocument->appendChild($sut);
		self::assertSame($sut, $sut->closest("example"));
	}

	public function testClosestParent():void {
		$sut = NodeTestFactory::createNode("example");
		$context = $sut->ownerDocument;
		for($i = 0; $i < 10; $i++) {
			$parent = $sut->ownerDocument->createElement("example-$i");
			$context->appendChild($parent);
			$context = $parent;
		}
		$context->appendChild($sut);

		$element = $sut->ownerDocument->getElementsByTagName("example-3")->item(0);
		$closest = $sut->closest("example-3");
		self::assertSame(
			$element,
			$closest
		);
	}

	public function testClosestWithAnotherMatchingAncestor():void {
		$sut = NodeTestFactory::createNode("example");
		$tagNames = ["this-example", "that-example"];
		$context = $sut->ownerDocument;
		for($i = 0; $i < 10; $i++) {
			$tagName = $i % 2 ? $tagNames[0] : $tagNames[1];
			$parent = $sut->ownerDocument->createElement($tagName);
			$context->appendChild($parent);
			$context = $parent;
		}
		$context->appendChild($sut);

		$thatElements = $sut->ownerDocument->getElementsByTagName("that-example");
		$closest = $sut->closest("that-example");
		self::assertSame(
			$thatElements->item($thatElements->length - 1),
			$closest
		);
	}

	public function testGetAttribute():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertNull($sut->getAttribute("attr"));
		$sut->setAttribute("attr", "content");
		self::assertEquals("content", $sut->getAttribute("attr"));
	}
}
