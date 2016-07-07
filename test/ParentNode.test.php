<?php
namespace phpgt\dom;

class ParentNodeTest extends \PHPUnit_Framework_TestCase {

public function testChildren() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$children = $document->body->children;
	$this->assertNotSame($children, $document->body->childNodes);
	$this->assertNotCount($document->body->childNodes->length, $children);

	$firstImg = $document->querySelector("img");
	$this->assertSame($firstImg, $children->item(1));
}

public function testFirstLastElementChild() {

}

public function testChildElementCount() {

}

}#