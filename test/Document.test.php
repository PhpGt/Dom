<?php
namespace g105b\Dom;

class DocumentTest extends \PHPUnit_Framework_TestCase {

const HTML = "<!doctype html><html><body><h1>Hello!</h1></body></html>";

public function testInheritance() {
	$document = new Document(self::HTML);
	$this->assertInstanceOf("g105b\Dom\Element", $document->documentElement);
}

}#