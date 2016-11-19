<?php
namespace Gt\Dom;


class Test extends \PHPUnit_Framework_TestCase {

/**
 * Use the documentation example at
 * https://developer.mozilla.org/docs/Web/API/Document/createDocumentFragment
 */
public function testFragmentCreates() {
	$document = new HTMLDocument(test\Helper::HTML_LIST);
	$ul = $document->getElementsByTagName("ul")[0];
	$docfrag = $document->createDocumentFragment();
	$browserList = [
		"Internet Explorer",
		"Firefox",
		"Safari",
		"Chrome",
		"Opera",
	];

	foreach($browserList as $browser) {
		$li = $document->createElement("li");
		$li->textContent = $browser;
		$docfrag->appendChild($li);
	}

	$ul->appendChild($docfrag);

	$this->assertCount(count($browserList), $ul->children);
	foreach($browserList as $browser) {
		$this->assertContains($browser, $ul->textContent);
	}
}

public function testGetElementById() {
	$document = new HTMLDocument(test\Helper::HTML);
	$fragment = $document->createDocumentFragment();

	$p1 = $document->createElement("p");
	$p1->id = "p1";

	$p2 = $document->createElement("p");
	$p2->id = "p2";

	$fragment->appendChild($p1);
	$fragment->appendChild($p2);

	$this->assertSame($p1, $fragment->getElementById("p1"));
	$this->assertSame($p2, $fragment->getElementById("p2"));
	$this->assertNull($fragment->getElementById("p3"));
}

public function testQuerySelector() {
	$document = new HTMLDocument(test\Helper::HTML);
	$fragment = $document->createDocumentFragment();

	$p1 = $document->createElement("p");
	$p1->classList->add("test");
	$p1->classList->add("first");

	$p2 = $document->createElement("p");
	$p2->classList->add("test");
	$p2->classList->add("second");

	$fragment->appendChild($p1);
	$fragment->appendChild($p2);

	$this->assertSame($p1, $fragment->querySelector("p.test.first"));
	$this->assertSame($p2, $fragment->querySelector(".second.test"));
	$this->assertNull($fragment->querySelector(".third"));
}

}#
