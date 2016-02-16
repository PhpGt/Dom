<?php
namespace phpgt\dom;

class ChildNodeTest extends \PHPUnit_Framework_TestCase {

public function testBefore() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$element = $document->getElementById("who");
	$currentBefore = $element->previousSibling;

	$newElement = $document->createElement("div");
	$element->before($newElement);

	$this->assertSame($newElement, $element->previousSibling);
	$this->assertSame($newElement, $currentBefore->nextSibling);
}

}#