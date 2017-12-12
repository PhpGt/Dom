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
}