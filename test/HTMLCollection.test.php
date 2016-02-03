<?php
namespace phpgt\dom;

class HTMLCollectionTest extends \PHPUnit_Framework_TestCase {

public function testType() {
	$document = new HTMLDocument(TestHelper::HTML);
	$this->assertInstanceOf("\phpgt\dom\HTMLCollection", $document->children);
}

public function testNonElementsRemoved() {
	$document = new HTMLDocument(TestHelper::HTML_MORE);
	$bodyChildNodes = $document->body->childNodes;
	$bodyChildren = $document->body->children;

	$this->assertInstanceOf("\DOMNodeList", $bodyChildNodes);
	$this->assertInstanceOf("\phpgt\dom\HTMLCollection", $bodyChildren);

	$this->assertInstanceOf("\phpgt\dom\Text", $bodyChildNodes->item(0));
	$this->assertInstanceOf("\phpgt\dom\Element", $bodyChildren->item(0));
}

}#