<?php
namespace Gt\Dom;

class NodeTest extends \PHPUnit_Framework_TestCase {

public function testHasAttribute() {
	$document = new HTMLDocument(test\Helper::HTML);
	$this->assertFalse($document->body->hasAttribute("example"));
	$document->body->setAttribute("example", "exampleValue");
	$this->assertTrue($document->body->hasAttribute("example"));
}

}#