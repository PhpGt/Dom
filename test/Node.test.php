<?php
namespace phpgt\dom;

class NodeTest extends \PHPUnit_Framework_TestCase {

public function testHashOnExtendedObjects() {
	// Somehow need to test that Node::getHash doesn't generate a different
	// hash to Element::getHash...
	$document = new HTMLDocument(TestHelper::HTML);
	$docEl = $document->documentElement;
}

}#