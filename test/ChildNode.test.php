<?php
namespace phpgt\dom;

class ChildNodeTest extends \PHPUnit_Framework_TestCase {

public function testRemove() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2List = $document->getElementsByTagName("h2");
	// TODO: assertCount once #19 closed
	$this->assertEquals(1, $h2List->length);

	$h2 = $h2List->item(0);
	$h2->remove();

	$this->assertEquals(0, $h2List->length);
}

public function testBefore() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementsByTagName("h2")->item(0);

	$div = $document->createElement("div");
	$h2->before($div);

	$this->assertSame($div, $h2->previousSibling);
	$this->assertSame($h2, $div->nextSibling);
}

}#