<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\ClientSide\CSSStyleDeclaration;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\Exception\EnumeratedValueException;
use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\Test\TestFactory\HTMLElementTestFactory;
use PHPUnit\Framework\TestCase;

class HTMLElementTest extends TestCase {
	public function testAccessKeyNone():void {
		$sut = HTMLElementTestFactory::create();
		self::assertEquals("", $sut->accessKey);
	}

	public function testAccessKeySetGet():void {
		$sut = HTMLElementTestFactory::create();
		$sut->accessKey = "a";
		self::assertEquals("a", $sut->accessKey);
		self::assertEquals(
			"a",
			$sut->getAttribute("accesskey")
		);
	}

	public function testAccessKeyLabelThrows():void {
		$sut = HTMLElementTestFactory::create();
		self::expectException(FunctionalityNotAvailableOnServerException::class);
		$test = $sut->accessKeyLabel;
	}

	public function testContentEditableInherit():void {
		$sut = HTMLElementTestFactory::create();
		self::assertEquals("inherit", $sut->contentEditable);
	}

	public function testContentEditable():void {
		$sut = HTMLElementTestFactory::create();
		$sut->contentEditable = "true";
		self::assertEquals("true", $sut->contentEditable);
		$sut->contentEditable = "false";
		self::assertEquals("false", $sut->contentEditable);
		$sut->contentEditable = "inherit";
		self::assertEquals("inherit", $sut->contentEditable);
	}

	public function testContentEditableEnum():void {
		$sut = HTMLElementTestFactory::create("div");
		self::expectException(EnumeratedValueException::class);
		$sut->contentEditable = "truthy";
	}

	public function testIsContentEditableDefault():void {
		$sut = HTMLElementTestFactory::create();
		self::assertFalse($sut->isContentEditable);
	}

	public function testIsContentEditableTrueFalse():void {
		$sut = HTMLElementTestFactory::create();
		$sut->contentEditable = "true";
		self::assertTrue($sut->isContentEditable);
		$sut->contentEditable = "false";
		self::assertFalse($sut->isContentEditable);
	}

	public function testIsContentEditableInheritNoParent():void {
		$sut = HTMLElementTestFactory::create();
		$sut->contentEditable = "inherit";
		self::assertFalse($sut->isContentEditable);
	}

	public function testIsContentEditableInheritParentWithFalse():void {
		$sut = HTMLElementTestFactory::create();
		$sut->contentEditable = "inherit";
		$falseContentEditable = $sut->ownerDocument->createElement("div");
		$falseContentEditable->contentEditable = "false";
		$falseContentEditable->appendChild($sut);
		self::assertFalse($sut->isContentEditable);
	}

	public function testIsContentEditableInheritParentWithTrue():void {
		$sut = HTMLElementTestFactory::create();
		$sut->contentEditable = "inherit";
		$falseContentEditable = $sut->ownerDocument->createElement("div");
		$falseContentEditable->contentEditable = "true";
		$falseContentEditable->appendChild($sut);
		self::assertTrue($sut->isContentEditable);
	}

	public function testIsContentEditableInheritAncestor():void {
		$sut = HTMLElementTestFactory::create();
		$sut->contentEditable = "inherit";
		$falseContentEditable = $sut->ownerDocument->createElement("div");
		$falseContentEditable->contentEditable = "true";
		$child1 = $sut->ownerDocument->createElement("div");
		$child2 = $sut->ownerDocument->createElement("div");
		$falseContentEditable->appendChild($child1);
		$child1->appendChild($child2);
		$child2->appendChild($sut);
		self::assertTrue($sut->isContentEditable);
	}

	public function testDirNone():void {
		$sut = HTMLElementTestFactory::create();
		self::assertEquals("", $sut->dir);
	}

	public function testDirGetSet():void {
		$sut = HTMLElementTestFactory::create();
		$sut->dir = "ltr";
		self::assertEquals("ltr", $sut->dir);
	}

	public function testDraggableNone():void {
		$sut = HTMLElementTestFactory::create();
		self::assertFalse($sut->draggable);
	}

	public function testDraggable():void {
		$sut = HTMLElementTestFactory::create();
		$sut->draggable = true;
		self::assertTrue($sut->draggable);
		self::assertEquals("true", $sut->getAttribute("draggable"));
		$sut->draggable = false;
		self::assertFalse($sut->draggable);
		self::assertEquals("false", $sut->getAttribute("draggable"));
	}

	public function testEnterKeyHintNone():void {
		$sut = HTMLElementTestFactory::create();
		self::assertEquals("", $sut->enterKeyHint);
	}

	public function testEnterKeyHint():void {
		$sut = HTMLElementTestFactory::create();
		$sut->enterKeyHint = "go";
		self::assertEquals("go", $sut->enterKeyHint);
		self::assertEquals("go", $sut->getAttribute("enterkeyhint"));
		$sut->enterKeyHint = "next";
		self::assertEquals("next", $sut->enterKeyHint);
		self::assertEquals("next", $sut->getAttribute("enterkeyhint"));
	}

	public function testEnterKeyHintBadEnum():void {
		$sut = HTMLElementTestFactory::create();
		self::expectException(EnumeratedValueException::class);
		$sut->enterKeyHint = "lalala";
	}

	public function testHiddenDefault():void {
		$sut = HTMLElementTestFactory::create();
		self::assertFalse($sut->hidden);
	}

	public function testHidden():void {
		$sut = HTMLElementTestFactory::create();
		$sut->hidden = true;
		self::assertTrue($sut->hidden);
		self::assertTrue($sut->hasAttribute("hidden"));
		self::assertEquals("", $sut->getAttribute("hidden"));
		$sut->hidden = false;
		self::assertFalse($sut->hidden);
		self::assertFalse($sut->hasAttribute("hidden"));
	}

	public function testInertDefault():void {
		$sut = HTMLElementTestFactory::create();
		self::assertFalse($sut->inert);
	}

	public function testInert():void {
		$sut = HTMLElementTestFactory::create();
		$sut->inert = true;
		self::assertTrue($sut->inert);
		self::assertTrue($sut->hasAttribute("inert"));
		self::assertEquals("", $sut->getAttribute("inert"));
		$sut->inert = false;
		self::assertFalse($sut->inert);
		self::assertFalse($sut->hasAttribute("inert"));
	}

	public function testInnerTextEmpty():void {
		$sut = HTMLElementTestFactory::create();
		self::assertEquals("", $sut->innerText);
	}

	public function testInnerText():void {
		$sut = HTMLElementTestFactory::create();
		$sut->innerText = "Hello, PHPUnit!";
		self::assertEquals("Hello, PHPUnit!", $sut->innerText);
	}

	public function testInnerTextRemovesAllChildren():void {
		$sut = HTMLElementTestFactory::create();
		$sut->append(
			$sut->ownerDocument->createElement("child"),
			$sut->ownerDocument->createElement("child"),
			$sut->ownerDocument->createElement("child")
		);
		$sut->innerText = "Hello, PHPUnit!";
		self::assertCount(1, $sut->childNodes);
	}

	public function testInnerTextDoesNotShowHidden():void {
		$sut = HTMLElementTestFactory::create();
		$child1 = $sut->ownerDocument->createElement("child");
		$child1->textContent = "Child 1";
		$child2 = $sut->ownerDocument->createElement("child");
		$child2->textContent = "Child 2";
		$child3 = $sut->ownerDocument->createElement("child");
		$child3->textContent = "Child 3";
		$sut->append($child1, $child2, $child3);

		$child2->hidden = true;
		self::assertEquals("Child 1Child 3", $sut->innerText);
	}

	public function testLangDefault():void {
		$sut = HTMLElementTestFactory::create();
		self::assertEquals("", $sut->lang);
	}

	public function testLang():void {
		$sut = HTMLElementTestFactory::create();
		$sut->lang = "en";
		self::assertEquals("en", $sut->lang);
		self::assertEquals("en", $sut->getAttribute("lang"));
	}

	public function testTabIndexDefault():void {
		$sut = HTMLElementTestFactory::create();
		self::assertEquals(-1, $sut->tabIndex);
	}

	public function testTabIndex():void {
		$sut = HTMLElementTestFactory::create();
		$sut->tabIndex = 1;
		self::assertEquals(1, $sut->tabIndex);
		self::assertEquals("1", $sut->getAttribute("tabindex"));
		$sut->tabIndex = 10;
		self::assertEquals("10", $sut->getAttribute("tabindex"));
		self::assertEquals(10, $sut->tabIndex);
	}

	public function testTitleDefault():void {
		$sut = HTMLElementTestFactory::create();
		self::assertEquals("", $sut->title);
	}

	public function testTitle():void {
		$sut = HTMLElementTestFactory::create();
		$sut->title = "Example";
		self::assertEquals("Example", $sut->title);
		self::assertEquals("Example", $sut->getAttribute("title"));
	}

	public function testStyleGet():void {
		$sut = HTMLElementTestFactory::create();
		self::expectException(ClientSideOnlyFunctionalityException::class);
		/** @noinspection PhpUnusedLocalVariableInspection */
		$value = $sut->style;
	}

	public function testStyleSet():void {
		$sut = HTMLElementTestFactory::create();
		$style = self::createMock(CSSStyleDeclaration::class);
		self::expectException(ClientSideOnlyFunctionalityException::class);
		$sut->style = $style;
	}
}
