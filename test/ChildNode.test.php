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

public function testAfter() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$element = $document->getElementById("who");
	$currentAfter = $element->nextSibling;

	$newElement = $document->createElement("div");
	$element->after($newElement);

	$this->assertSame($newElement, $element->nextSibling);
	$this->assertSame($newElement, $currentAfter->previousSibling);
}

}#