<?php
namespace Gt\Dom;

class DocumentFragmentTest extends \PHPUnit_Framework_TestCase {

public function testQuerySelector() {
	$document = new HTMLDocument();
	$fragment = $document->createDocumentFragment();

	$expectedFirstLi = null;

	foreach(["Firefox", "Chrome", "Opera", "Safari", "Internet Explorer"]
	as $browser) {
		$li = $document->createElement("li");
		$li->textContent = $browser;
		$fragment->appendChild($li);

		if(is_null($expectedFirstLi)) {
			$expectedFirstLi = $li;
		}
	}

	$actualFirstLi = $fragment->querySelector("li");
	$this->assertSame($expectedFirstLi, $actualFirstLi);
}

public function testQuerySelectorAll() {
	$document = new HTMLDocument();
	$fragment = $document->createDocumentFragment();

	$expectedCount = 0;
	foreach(["Firefox", "Chrome", "Opera", "Safari", "Internet Explorer"]
	as $browser) {
		$expectedCount++;
		$li = $document->createElement("li");
		$li->textContent = $browser;
		$fragment->appendChild($li);
	}

	$liCollection = $fragment->querySelectorAll("li");
	$this->assertCount($expectedCount, $liCollection);
}

public function testAppends() {
	$document = new HTMLDocument("<!doctype html><body><ul></ul></body>");
	$fragment = $document->createDocumentFragment();

	$expectedCount = 0;
	foreach(["Firefox", "Chrome", "Opera", "Safari", "Internet Explorer"]
	as $browser) {
		$expectedCount++;
		$li = $document->createElement("li");
		$li->textContent = $browser;
		$fragment->appendChild($li);
	}

	$ul = $document->querySelector("ul");
	$ul->appendChild($fragment);

	$this->assertCount(
		$expectedCount,
		$document->querySelectorAll("body>ul>li")
	);
}

}#