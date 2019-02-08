<?php
namespace Gt\Dom\Test;

use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase {
	public function testIsElementContentWhitespace() {
		$document = new HTMLDocument(Helper::HTML_MORE);
		$firstChild = $document->body->firstChild;
		$this->assertTrue($firstChild->isElementContentWhitespace());

		$h1 = $document->querySelector("h1");
		$h1Child = $h1->firstChild;
		$this->assertFalse($h1Child->isElementContentWhitespace());
	}

	public function testWholeText() {
		$document = new HTMLDocument(Helper::HTML_TEXT);
		$para = $document->querySelector("p");
// Remove the <strong>
		$para->childNodes[1]->remove();
// WholeText should contain all text up to the link.
		$textNode = $para->firstChild;
		$this->assertStringContainsString("Thru-hiking is great!", $textNode->wholeText);
		$this->assertStringContainsString(" However, ", $textNode->wholeText);
	}

	public function testSplitText() {
		$document = new HTMLDocument(Helper::HTML_TEXT);
		$para = $document->querySelector("p");
		$textNode = $para->firstChild;
		$textNode->splitText(4);

		$this->assertEquals("Thru", $para->firstChild->textContent);
		$this->assertStringContainsString("-hiking is great!",
			$para->firstChild->nextSibling->textContent);
	}
}