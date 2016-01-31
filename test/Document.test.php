<?php
namespace phpgt\dom;

class DocumentTest extends \PHPUnit_Framework_TestCase {

const HTML = "<!doctype html><html><body><h1>Hello!</h1></body></html>";

public function testInheritance() {
	$document = new Document(self::HTML);
	$this->assertInstanceOf("phpgt\dom\Element", $document->documentElement);
}

public function testRemoveElement() {
	$document = new Document(self::HTML);

	$h1List = $document->getElementsByTagName("h1");
	$this->assertEquals(1, $h1List->length);
	$h1 = $h1List->item(0);
	$h1->remove();

	$h1List = $document->getElementsByTagName("h1");
	$this->assertEquals(0, $h1List->length);
}

}#