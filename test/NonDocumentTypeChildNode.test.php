<?php
namespace phpgt\dom;

class NonDocumentTypeChildNodeTest extends \PHPUnit_Framework_TestCase {

public function testElementSiblings() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$whoHeading = $document->getElementById("who");
	$plugParagraph = $document->querySelector("p.plug");
	$formsAnchor = $document->querySelector("a[name='forms']");

	$this->assertSame($formsAnchor, $whoHeading->nextElementSibling);
	$this->assertSame($plugParagraph, $whoHeading->previousElementSibling);

	$this->assertInstanceOf(
		"\phpgt\dom\Element", $formsAnchor);
// The character data after the forms anchor is surrounded by empty text nodes.
	$this->assertInstanceOf(
		"\phpgt\dom\CharacterData", $formsAnchor->nextElementSibling);
}

}#