<?php
namespace phpgt\dom;

class HTMLCollectionTest extends \PHPUnit_Framework_TestCase {

public function testType() {
	$document = new HTMLDocument(TestHelper::HTML);
	$this->assertInstanceOf("\phpgt\dom\HTMLCollection", $document->children);
}

/**
 * The type of the Nodes that are stored within an HTMLCollection should only
 * be derivatives of Element.
 */
public function testElementType() {

}

}#