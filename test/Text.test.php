<?php
namespace Gt\Dom;

use Gt\Dom\HTMLDocument;

class TextTest extends \PHPUnit_Framework_TestCase {

public function testIsElementContentWhitespace() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$firstChild = $document->body->firstChild;
	$this->assertTrue($firstChild->isElementContentWhitespace());

	$h1 = $document->querySelector("h1");
	$h1Child = $h1->firstChild;
	$this->assertFalse($h1Child->isElementContentWhitespace());
}

}#