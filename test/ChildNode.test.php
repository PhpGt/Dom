<?php
namespace Gt\Dom;

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

public function testReplaceWith() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$element = $document->getElementById("who");
	$currentBefore = $element->previousSibling;

	$newElement = $document->createElement("div");
	$element->replaceWith($newElement);

	$this->assertSame($newElement, $currentBefore->nextSibling);
}

public function testReplaceWithInSameDocument() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementById("who");
	$beforeH2 = $h2->previousSibling;
	$h1 = $document->firstChild;

	$h2->replaceWith($h1);
	$this->assertSame($h1, $beforeH2->nextSibling);
	$this->assertNotSame($h1, $document->firstChild);
}

}#