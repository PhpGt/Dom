<?php
namespace phpgt\dom;

class ElementTest extends \PHPUnit_Framework_TestCase {

public function testQuerySelector() {
	$document = new HTMLDocument(TestHelper::HTML_MORE);
	$pAfterH2 = $document->querySelector("h2+p");
	$aWithinP = $pAfterH2->querySelector("a");

	$a = $document->querySelector("p>a");

	$this->assertInstanceOf("\phpgt\dom\Element", $pAfterH2);
	$this->assertInstanceOf("\phpgt\dom\Element", $aWithinP);
	$this->assertInstanceOf("\phpgt\dom\Element", $a);
	$this->assertSame($a, $aWithinP);
}

}#