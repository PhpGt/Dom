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


}#
