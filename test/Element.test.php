<?php
namespace phpgt\dom;

class ElementTest extends \PHPUnit_Framework_TestCase {

public function testQuerySelector() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$pAfterH2 = $document->querySelector("h2+p");
	$aWithinP = $pAfterH2->querySelector("a");

	$a = $document->querySelector("p>a");

	$this->assertInstanceOf("\phpgt\dom\Element", $pAfterH2);
	$this->assertInstanceOf("\phpgt\dom\Element", $aWithinP);
	$this->assertInstanceOf("\phpgt\dom\Element", $a);
	$this->assertSame($a, $aWithinP);
}

public function testQuerySelectorAll() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$pCollection = $document->documentElement->querySelectorAll("p");
	$pNodeList = $document->documentElement->getElementsByTagName("p");

	$this->assertEquals($pNodeList->length, $pCollection->length);
}

public function testMatches() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$p = $document->getElementsByClassName("plug")->item(0);

	$this->assertTrue($p->matches("p"));
	$this->assertTrue($p->matches("p.plug"));
	$this->assertTrue($p->matches("body>p:nth-of-type(3)"));
	$this->assertTrue($p->matches("p:nth-of-type(3)"));
	$this->assertTrue($p->matches("body>*"));
	$this->assertFalse($p->matches("div"));
	$this->assertFalse($p->matches("body>p:nth-of-type(4)"));
}

public function testChildElementCount() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	// There is 1 text node within the document.
	$this->assertGreaterThan(
		$document->body->childElementCount,
		$document->body->childNodes->length
	);
	$this->assertEquals(
		$document->body->children->length,
		$document->body->childElementCount
	);
}

}#