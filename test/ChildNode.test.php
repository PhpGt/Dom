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

public function testAfter() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementsByTagName("h2")->item(0);

	$div = $document->createElement("div");
	$h2->after($div);

	$this->assertSame($div, $h2->nextSibling);
	$this->assertSame($h2, $div->previousSibling);
}

public function testReplaceWith() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$h2 = $document->getElementsByTagName("h2")->item(0);

	$beforeH2 = $h2->previousSibling;
	$afterH2 = $h2->nextSibling;

	$div = $document->createElement("div");
	$h2->replaceWith($div);

	$this->assertSame($div, $beforeH2->nextSibling);
	$this->assertSame($beforeH2, $div->previousSibling);
	$this->assertSame($div, $afterH2->previousSibling);
	$this->assertSame($afterH2, $div->nextSibling);

	$this->assertNull($h2->parentNode);
}
}#