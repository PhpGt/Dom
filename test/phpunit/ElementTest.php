<?php
namespace Gt\Dom\Test;

use Gt\Dom\Element;
use Gt\Dom\Exception\InvalidAdjacentPositionException;
use Gt\Dom\Exception\InvalidCharacterException;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use Gt\Dom\Text;
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

	public function testClassListMutate():void {
		$sut = NodeTestFactory::createNode("example");
		$classList = $sut->classList;
		self::assertFalse($classList->contains("a-class"));
		$sut->className = "something another-thing a-class final-class";
		$classList->value = "totally different class-list";
		self::assertFalse($classList->contains("something"));
		self::assertFalse($classList->contains("another-thing"));
		self::assertFalse($classList->contains("a-class"));
		self::assertFalse($classList->contains("final-class"));
	}

	public function testClassListMutateUpdatesElement():void {
		$sut = NodeTestFactory::createNode("example");
		$classList = $sut->classList;
		self::assertFalse($classList->contains("a-class"));
		$sut->className = "something another-thing a-class final-class";
		$classList->value = "updated";

		self::assertFalse($classList->contains("something"));
		self::assertFalse($sut->classList->contains("something"));

		self::assertTrue($classList->contains("updated"));
		self::assertTrue($sut->classList->contains("updated"));

		self::assertEquals("updated", $sut->className);
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

	public function testInnerHTML_unicode():void {
		// Note the special apostrophe.
		$message = "Let’s go on a digital journey together.";
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = $message;
		self::assertEquals($message, $sut->innerHTML);
	}

	public function testInnerHTML_emoji():void {
		$message = "I ❤️ my 🐈";
		$sut = NodeTestFactory::createNode("example");
		$sut->innerHTML = $message;
		self::assertEquals($message, $sut->innerHTML);
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

	public function testGetAttributeNamesNone():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertCount(0, $sut->getAttributeNames());
	}

	public function testGetAttributeNames():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->setAttribute("name", "test");
		$sut->setAttribute("framework", "phpunit");
		$attributeNames = $sut->getAttributeNames();
		self::assertCount(2, $attributeNames);
		self::assertContains("name", $attributeNames);
		self::assertContains("framework", $attributeNames);
	}

	public function testGetAttributeNS():void {
		$xmlDoc = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_SHAPE);
		$sut = $xmlDoc->getElementById("target");
		$ns = "http://www.example.com/2014/test";
		self::assertEquals(
			"Foo value",
			$sut->getAttributeNS($ns, "foo"));
	}

	public function testGetAttributeNSNone():void {
		$xmlDoc = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_SHAPE);
		$sut = $xmlDoc->getElementById("target");
		$ns = "http://www.example.com/2014/test";
		self::assertNull($sut->getAttributeNS($ns, "nothing"));
	}

	public function testGetElementsByClassName():void {
		$sut = NodeTestFactory::createNode("example");
		/** @var Element $child1 */
		$child1 = $sut->cloneNode();
		/** @var Element $child2 */
		$child2 = $sut->cloneNode();
		/** @var Element $child3 */
		$child3 = $sut->cloneNode();

		$child1->className = "one child-of-sut";
		$child2->className = "two child-of-sut another-class";
		$child3->className = "three child-of-sut another-class";

		$sut->append($child1, $child2, $child3);
		self::assertCount(1, $sut->getElementsByClassName("one"));
		self::assertCount(1, $sut->getElementsByClassName("two"));
		self::assertCount(1, $sut->getElementsByClassName("three"));
		self::assertCount(3, $sut->getElementsByClassName("child-of-sut"));
		self::assertCount(2, $sut->getElementsByClassName("another-class"));
	}

	public function testGetElementsByClassNameIsLive():void {
		$sut = NodeTestFactory::createNode("example");
		/** @var Element $child1 */
		$child1 = $sut->cloneNode();

		$child1->className = "one child-of-sut";
		$sut->append($child1);
		self::assertCount(1, $sut->getElementsByClassName("one"));
		$child1->className = "not-one child-of-sut";
		self::assertCount(0, $sut->getElementsByClassName("one"));
		self::assertCount(0, $sut->getElementsByClassName("one child-of-sut"));
	}

	public function testGetElementsByTagName():void {
		$sut = NodeTestFactory::createNode("example");
		$child1 = $sut->cloneNode();
		$sut->append($child1);
		self::assertSame(
			$child1,
			$sut->getElementsByTagName("example")->item(0)
		);
	}

	public function testGetElementsByTagNameNS():void {
		$xmlDoc = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_SHAPE);
		$sut = $xmlDoc->documentElement;
		$ns = "http://www.example.com/2014/test";
		self::assertCount(
			1,
			$sut->getElementsByTagNameNS($ns, "rect")
		);
		self::assertCount(
			0,
			$sut->getElementsByTagNameNS("another-namespace", "rect")
		);
	}

	public function testHasAttributes():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertFalse($sut->hasAttributes());
		$sut->setAttribute("test", "123");
		self::assertTrue($sut->hasAttributes());
	}

	public function testInsertAdjacentElementAfterBegin():void {
		$sut = NodeTestFactory::createNode("example");
		$pad = $sut->ownerDocument->createElement("pad");
		$sut->append($pad);

		/** @var Element $toInsert */
		$toInsert = $sut->cloneNode();
		$inserted = $sut->insertAdjacentElement(
			"afterbegin",
			$toInsert
		);
		self::assertInstanceOf(Element::class, $inserted);
		self::assertSame($sut, $inserted->parentNode);
		self::assertSame($pad, $inserted->nextSibling);
	}

	public function testInsertAdjacentElementBeforeEnd():void {
		$sut = NodeTestFactory::createNode("example");
		$pad = $sut->ownerDocument->createElement("pad");
		$sut->append($pad);

		/** @var Element $toInsert */
		$toInsert = $sut->cloneNode();
		$inserted = $sut->insertAdjacentElement(
			"beforeend",
			$toInsert
		);
		self::assertInstanceOf(Element::class, $inserted);
		self::assertSame($sut, $inserted->parentNode);
		self::assertSame($pad, $inserted->previousSibling);
	}

	public function testInsertAdjacentElementBeforeBeginNotConnected():void {
		$sut = NodeTestFactory::createNode("example");
		/** @var Element $toInsert */
		$toInsert = $sut->cloneNode();
		$inserted = $sut->insertAdjacentElement(
			"beforebegin",
			$toInsert
		);
		self::assertNull($inserted);
	}

	public function testInsertAdjacentElementBeforeBegin():void {
		$sut = NodeTestFactory::createNode("example");
		$root = $sut->ownerDocument->createElement("root");
		$sut->ownerDocument->appendChild($root);
		$pad = $sut->ownerDocument->createElement("pad");
		$root->appendChild($pad);
		$root->appendChild($sut);

		/** @var Element $toInsert */
		$toInsert = $sut->cloneNode();
		$inserted = $sut->insertAdjacentElement(
			"beforebegin",
			$toInsert
		);
		self::assertInstanceOf(Element::class, $inserted);
		self::assertSame($pad, $inserted->previousSibling);
	}

	public function testInsertAdjacentElementAfterEndNotConnected():void {
		$sut = NodeTestFactory::createNode("example");
		/** @var Element $toInsert */
		$toInsert = $sut->cloneNode();
		$inserted = $sut->insertAdjacentElement(
			"afterend",
			$toInsert
		);
		self::assertNull($inserted);
	}

	public function testInsertAdjacentElementAfterEnd():void {
		$sut = NodeTestFactory::createNode("example");
		$root = $sut->ownerDocument->createElement("root");
		$sut->ownerDocument->appendChild($root);
		$pad = $sut->ownerDocument->createElement("pad");
		$root->appendChild($sut);
		$root->appendChild($pad);

		/** @var Element $toInsert */
		$toInsert = $sut->cloneNode();
		$inserted = $sut->insertAdjacentElement(
			"afterend",
			$toInsert
		);
		self::assertInstanceOf(Element::class, $inserted);
		self::assertSame($pad, $inserted->nextSibling);
	}

	public function testInsertAdjacentElementInvalidPosition():void {
		$sut = NodeTestFactory::createNode("example");
		/** @var Element $toInsert */
		$toInsert = $sut->cloneNode();
		self::expectException(InvalidAdjacentPositionException::class);
		$sut->insertAdjacentElement(
			"nowhere",
			$toInsert
		);
	}

	public function testInsertAdjacentHTML():void {
		$sut = NodeTestFactory::createNode("example");
		$pad = $sut->ownerDocument->createElement("pad");
		$sut->appendChild($pad);
		$sut->insertAdjacentHTML(
			"afterbegin",
			"<inserted>Testing</inserted>"
		);
		self::assertCount(2, $sut->childNodes);
		self::assertSame(
			$pad,
			$sut->getElementsByTagName("inserted")->item(0)->nextSibling
		);
	}

	public function testInsertAdjacentText():void {
		$sut = NodeTestFactory::createNode("example");
		$pad = $sut->ownerDocument->createElement("pad");
		$sut->appendChild($pad);
		$sut->insertAdjacentText(
			"afterbegin",
			"This is a text node!"
		);
		self::assertCount(2, $sut->childNodes);
		self::assertSame(
			$pad,
			$sut->childNodes->item(0)->nextSibling
		);
		self::assertInstanceOf(Text::class, $sut->firstChild);
	}

	public function testMatches():void {
		$sut = NodeTestFactory::createNode("example");
		$sut->ownerDocument->appendChild($sut);
		self::assertTrue($sut->matches("example"));
		self::assertFalse($sut->matches("not-example"));
	}

	public function testSetAttributeNS():void {
		$xmlDoc = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_SHAPE);
		$sut = $xmlDoc->getElementById("target");
		$ns = "http://www.example.com/2014/test";
		$sut->setAttributeNS($ns, "foo", "Updated value");
		self::assertEquals(
			"Updated value",
			$sut->getAttributeNS($ns, "foo"));
	}

	public function testToggleAttribute():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertFalse($sut->hasAttribute("required"));
		$requiredPresent = $sut->toggleAttribute("required");
		self::assertTrue($sut->hasAttribute("required"));
		self::assertTrue($requiredPresent);
		$requiredPresent = $sut->toggleAttribute("required");
		self::assertFalse($sut->hasAttribute("required"));
		self::assertFalse($requiredPresent);
	}

	public function testToggleAttributeForced():void {
		$sut = NodeTestFactory::createNode("example");
		self::assertTrue(
			$sut->toggleAttribute("required", true)
		);
		self::assertTrue($sut->hasAttribute("required"));
		self::assertTrue(
			$sut->toggleAttribute("required", true)
		);
		self::assertTrue($sut->hasAttribute("required"));

		self::assertFalse(
			$sut->toggleAttribute("required", false)
		);
		self::assertFalse($sut->hasAttribute("required"));
		self::assertFalse(
			$sut->toggleAttribute("required", false)
		);
		self::assertFalse($sut->hasAttribute("required"));
	}

	public function testRemoveAttributeNS():void {
		$xmlDoc = DocumentTestFactory::createXMLDocument(DocumentTestFactory::XML_SHAPE);
		$sut = $xmlDoc->getElementById("target");
		$ns = "http://www.example.com/2014/test";
		$sut->removeAttributeNS($ns, "foo");
		self::assertFalse(
			$sut->hasAttributeNS($ns, "foo"));
	}
}
