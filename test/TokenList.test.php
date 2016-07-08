<?php
namespace phpgt\dom;

class TokenListTest extends \PHPUnit_Framework_TestCase {

public function testItem() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementById("who");
	$tokenList = new TokenList($h2, "class");
	$this->assertEquals("h-who", $tokenList->item(0));
	$this->assertEquals("m-test", $tokenList->item(2));
}

}#