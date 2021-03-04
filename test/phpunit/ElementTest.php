<?php
namespace Gt\Dom\Test;

use Gt\Dom\Element;
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

	public function testOuterHTMLSet():void {
		$sut = NodeTestFactory::createNode("example");
		$innerHTML = "<p>A paragraph</p>";
		$sut->outerHTML = "<changed-outer>$innerHTML</changed-outer>";
		self::assertEquals($innerHTML, $sut->innerHTML);
		self::assertEquals(
			"<changed-outer><p>A paragraph</p></changed-outer>",
			$sut->outerHTML
		);
	}

	public function testOuterHTMLSetMultiple():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->outerHTML = "<first-outer>Example1</first-outer><second-outer>Example2</second-outer>";
		self::assertEquals(
			"<first-outer>Example1</first-outer>",
			$sut->outerHTML
		);
	}

	public function testOuterHTMLParent():void {
		$html = "<changed-tag>Some content</changed-tag>";
		$sut = NodeTestFactory::createNode("example");
		$sut->ownerDocument->appendChild($sut);
		$sut->outerHTML = $html;
		self::assertEquals($html, $sut->outerHTML);
//		self::assertEquals($html, $sut->ownerDocument->documentElement->innerHTML);
	}

	public function testChildren():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = "<p>A paragraph</p>
		<div>A div</div>";
		self::assertCount(2, $sut->children);
		self::assertEquals("A paragraph", $sut->children[0]->innerHTML);
		self::assertEquals("A div", $sut->children[1]->innerHTML);
	}
}
