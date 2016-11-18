<?php
namespace Gt\Dom;

class ElementTest extends \PHPUnit_Framework_TestCase {

public function testQuerySelector() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$pAfterH2 = $document->querySelector("h2+p");
	$aWithinP = $pAfterH2->querySelector("a");

	$a = $document->querySelector("p>a");

	$this->assertInstanceOf("\Gt\Dom\Element", $pAfterH2);
	$this->assertInstanceOf("\Gt\Dom\Element", $aWithinP);
	$this->assertInstanceOf("\Gt\Dom\Element", $a);
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
	$this->assertInstanceOf('\Gt\Dom\Element', $p);

	$innerList = $document->querySelector('.inner-list');
	$this->assertInstanceOf('\Gt\Dom\Element', $innerList);

	$closestUl = $innerList->closest('ul');
	$this->assertEquals($innerList, $closestUl);

	$container = $p->closest('.container');
	$this->assertInstanceOf('\Gt\Dom\Element', $container);

	$nonExistentClosestElement = $p->closest('br');
	$this->assertNull($nonExistentClosestElement);

	$innerPost = $document->querySelector("div.post.inner");
	$innerListItem = $document->querySelector(".inner-item-1");
	$outerPost = $document->querySelector("div.post.outer");
	$this->assertInstanceOf("\Gt\Dom\Element", $innerPost);
	$this->assertInstanceOf("\Gt\Dom\Element", $outerPost);

	$closestDivToInnerListItem = $innerListItem->closest("div");
	$closestDivToInnerPost = $innerPost->closest("div");
// ..the inner post should match itself, as it is a div.
	$this->assertSame($closestDivToInnerPost, $innerPost);
// ..but the inner list item should match up the tree to the outer post
// ..missing the other divs in the tree.
	$this->assertSame($closestDivToInnerListItem, $outerPost);
}

public function testValueGetter() {
	$document = new HTMLDocument(test\Helper::HTML_VALUE);

	$select = $document->getElementById('select');
	$this->assertEquals('1', $select->value);	
	$select->value = '2';
	$this->assertEquals('2', $select->value);

	$select = $document->getElementById('select_optgroup');
	$this->assertEquals('3', $select->value);
	$select->value = '4';
	$this->assertEquals('4', $select->value);

	$select = $document->getElementById('select_selected');
	$this->assertEquals('2', $select->value);

	$select = $document->getElementById('select_empty');
	$this->assertEquals('', $select->value);
	$select->value = 'dummy';
	$this->assertEquals('', $select->value);
}
}#
