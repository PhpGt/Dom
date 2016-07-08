<?php
namespace phpgt\dom;

class TokenListTest extends \PHPUnit_Framework_TestCase {

public function testLength() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementById("who");
	$this->assertEquals(0, $document->body->classList->length);
	$this->assertEquals(3, $h2->classList->length);
}

public function testItem() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementById("who");
	$tokenList = new TokenList($h2, "class");
	$this->assertEquals("h-who", $tokenList->item(0));
	$this->assertEquals("m-test", $tokenList->item(2));
}

public function testContains() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementById("who");
	$this->assertTrue($h2->classList->contains("m-before-p"));
	$this->assertFalse($h2->classList->contains("nothing"));
	$this->assertFalse($h2->classList->contains(""));
	$this->assertFalse($h2->classList->contains("c1"));
}

public function testAdd() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementById("who");
	$classString = "h-who m-before-p m-test";
	$this->assertEquals($classString, $h2->getAttribute("class"));

	$h2->classList->add("added-here");
	$this->assertEquals("$classString added-here", $h2->getAttribute("class"));
}

}#