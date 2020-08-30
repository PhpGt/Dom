<?php
namespace Gt\Dom\Test;

use Gt\Dom\Element;
use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use Gt\Dom\Text;
use PHPUnit\Framework\TestCase;

class ParentNodeTest extends TestCase {
	public function testChildren() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$children = $document->body->children;
		$this->assertNotSame($children, $document->body->childNodes);
		$this->assertNotCount($document->body->childNodes->length, $children);

		$firstImg = $document->querySelector("img");
		$this->assertSame($firstImg, $children->item(1));
	}

	public function testFirstLastElementChild() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$this->assertInstanceOf(
			Text::class, $document->body->firstChild);
		$this->assertInstanceOf(
			Element::class, $document->body->firstElementChild);
	}

	public function testChildElementCount() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$this->assertInstanceOf(
			Text::class, $document->body->lastChild);
		$this->assertInstanceOf(
			Element::class, $document->body->lastElementChild);
	}

	public function testQuerySelectorNotSelectSelf() {
		$document = new HTMLDocument(Helper::HTML_LESS);
		$p = $document->querySelector("p");
		$innerP = $p->querySelector("p");
		self::assertNull($innerP);
	}

	public function testIterateOverChildNodes() {
		$document = new HTMLDocument(Helper::HTML_MORE);

		$form = $document->querySelector("form");
		$originalChildNodeCount = $form->childNodes->length;
		$childNodes = [];
		for($i = 0, $len = $originalChildNodeCount; $i < $len; $i++) {
			$childNodes []= $form->childNodes->item($i);
		}

		$fragment = $document->createDocumentFragment();
		foreach($childNodes as $child) {
			$fragment->appendChild($child);
		}

		self::assertEquals(
			$originalChildNodeCount,
			$fragment->childNodes->length
		);
	}
}