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
    $document = new HTMLDocument(test\Helper::HTML_NESTED);

    $p = $document->querySelector('.inner-list p');
    // test if p is an element
    $this->assertInstanceOf('\phpgt\dom\Element', $p);

    $innerList = $document->querySelector('.inner-list');
    // test if .inner-list is an element
    $this->assertInstanceOf('\phpgt\dom\Element', $innerList);

    $closestUl = $innerList->closest('ul');
    // test if the closest element is .inner-list
    $this->assertEquals($innerList, $closestUl);

    // test something far just to be sure
    $container = $p->closest('.container');
    $this->assertInstanceOf('\phpgt\dom\Element', $container);

    // test if closest is returning null for unknown element
    $nonExistentClosestElement = $p->closest('br');
    $this->assertNull($nonExistentClosestElement);
}

}#