<?php
namespace phpgt\dom;

class DocumentTest extends \PHPUnit_Framework_TestCase {

public function testInheritance() {
	$document = new HTMLDocument(TestHelper::HTML);
	$this->assertInstanceOf("phpgt\dom\Element", $document->documentElement);
}

public function testRemoveElement() {
	$document = new HTMLDocument(TestHelper::HTML);

	$h1List = $document->getElementsByTagName("h1");
	$this->assertEquals(1, $h1List->length);
	$h1 = $h1List->item(0);
	$h1->remove();

	$h1List = $document->getElementsByTagName("h1");
	$this->assertEquals(0, $h1List->length);
}

public function testQuerySelector() {
	$document = new HTMLDocument(TestHelper::HTML_MORE);
	$h2TagName = $document->getElementsByTagName("h2")->item(0);
	$h2QuerySelector = $document->querySelector("h2");

	$this->assertSame($h2QuerySelector, $h2TagName);
}

public function testQuerySelectorAll() {
	$document = new HTMLDocument(TestHelper::HTML_MORE);
	$pListTagName = $document->getElementsByTagName("p");
	$pListQuerySelector = $document->querySelectorAll("p");

	$this->assertEquals($pListTagName->length, $pListQuerySelector->length);

	for($i = 0, $len = $pListQuerySelector->length; $i < $len; $i++) {
		$this->assertSame(
			$pListQuerySelector->item($i),
			$pListTagName->item($i)
		);
	}
}

public function testHeadElement() {
	$document = new HTMLDocument(TestHelper::HTML_MORE);
	$this->assertInstanceOf("\phpgt\dom\Element", $document->head);
}

public function testHeadElementAutomaticallyCreated() {
	// TestHelper::HTML does not explicitly define a <head>
	$document = new HTMLDocument(TestHelper::HTML);
	$this->assertInstanceOf("\phpgt\dom\Element", $document->head);
}

public function testBodyElement() {
	$document = new HTMLDocument(TestHelper::HTML_MORE);
	$this->assertInstanceOf("\phpgt\dom\Element", $document->body);
}

public function testBodyElementAutomaticallyCreated() {
	// TestHelper::HTML does not explicitly define a <body>
	$document = new HTMLDocument(TestHelper::HTML);
	$this->assertInstanceOf("\phpgt\dom\Element", $document->body);
}

}#