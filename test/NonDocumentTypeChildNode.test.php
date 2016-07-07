<?php
namespace phpgt\dom;

class NonDocumentTypeChildNodeTest extends \PHPUnit_Framework_TestCase {

public function testElementSiblings() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$whoHeading = $document->getElementById("who");
	$plugParagraph = $document->querySelector("p.plug");
	$formsAnchor = $document->querySelector("a[name='forms']");

	$this->assertEquals("p", $whoHeading->nextElementSibling->tagName);
	$this->assertSame($formsAnchor,
		$whoHeading->nextElementSibling->nextElementSibling);
	$this->assertSame($plugParagraph, $whoHeading->previousElementSibling);

	$this->assertInstanceOf(
		"\phpgt\dom\Element", $formsAnchor);

	$firstImg = $document->querySelector("img");
	$this->assertEquals("h1", $firstImg->previousElementSibling->tagName);
	$this->assertNull(
		$firstImg->previousElementSibling->previousElementSibling);
	$this->assertNull(
		$document->body->lastElementChild->nextElementSibling);
}

}#