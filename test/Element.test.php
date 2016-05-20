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

public function testElementClosest() {
    $document = new HTMLDocument(test\Helper::HTML_MORE);

    $p = $document->querySelector('h2+p');
    // test if p is an element
    $this->assertInstanceOf('\phpgt\dom\Element', $p);

    $a = $document->querySelector('h2+p > a');
    // test if a is an element
    $this->assertInstanceOf('\phpgt\dom\Element', $a);

    $itself = $a->closest('a');
    // test if the closest element is a itself
    $this->assertEquals($a, $itself);

    // test something far just to be sure
    $body = $a->closest('body');
    $this->assertEquals($body, $document->body);

    $closestElement = $a->closest('p');
    // test if closest is a valid element
    $this->assertInstanceOf('\phpgt\dom\Element', $closestElement);
    // test if the closest element is p
    $this->assertEquals($p, $closestElement);

    // test if closest is returning null for unknown element
    $nonExistentClosestElement = $a->closest('br');
    $this->assertNull($nonExistentClosestElement);
}

}#