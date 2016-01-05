<?php
namespace g105b\Dom;

class DocumentTest extends \PHPUnit_Framework_TestCase {

public function testInheritance() {
	$document = new Document();
	$this->assertInstanceOf("g105b\Dom\Node", $document);
}

}#