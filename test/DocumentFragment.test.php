<?php
namespace Gt\Dom;

class DocumentFragmentTest extends \PHPUnit_Framework_TestCase {

const DOC_CONTENT_BEFORE_INSERT = "<!doctype html><body>"
	. "<div><ul><li>outOfScope</li></ul></div>"
	. "<span id='replaceWithSUT'></span>"
	. "<div><ul><li>outOfScope</li></ul></div>"
	. "</body>";

private $browserList = [
	"Firefox",
	"Chrome",
	"Opera",
	"Safari",
	"Internet Explorer",
];

public function testQuerySelectorBeforeAddingToDocument() {
	$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);
	$fragment = $document->createDocumentFragment();

	$expectedFirstLi = null;

	$browserList = [
		"Firefox",
		"Chrome",
		"Opera",
		"Safari",
		"Internet Explorer",
	];

	foreach($browserList as $browser) {
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

public function testQuerySelectorAllBeforeAddingToDocument() {
	$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);
	$fragment = $document->createDocumentFragment();

	$expectedCount = 0;
	foreach($this->browserList as $browser) {
		$expectedCount++;
		$li = $document->createElement("li");
		$li->textContent = $browser;
		$fragment->appendChild($li);
	}

	$liCollection = $fragment->querySelectorAll("li");
	$this->assertCount($expectedCount, $liCollection);
}

public function testAppendsToDocument() {
	$document = new HTMLDocument("<!doctype html><body><ul></ul></body>");
	$fragment = $document->createDocumentFragment();

	$expectedCount = 0;
	$expectedFirstLi = null;
	foreach(["Firefox", "Chrome", "Opera", "Safari", "Internet Explorer"]
	as $browser) {
		$expectedCount++;
		$li = $document->createElement("li");
		$li->textContent = $browser;
		$fragment->appendChild($li);

		if(is_null($expectedFirstLi)) {
			$expectedFirstLi = $li;
		}
	}

	$ul = $document->querySelector("ul");
	$ul->appendChild($fragment);

	$actualResult = $document->querySelectorAll("body>ul>li");
	$this->assertCount($expectedCount, $actualResult);
	$this->assertSame($expectedFirstLi, $actualResult[0]);
}

public function testQuerySelectorAfterAddingToDocument() {
	$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

	$fragment = $document->createDocumentFragment();
	$fragment->appendXML("<ul><li id='new-frag-li'>inScope</li></ul>");

	$document->querySelector("span#replaceWithSUT")->replaceWith($fragment);

	$fragLi = $fragment->querySelector("li");
	$bodyLi = $document->querySelector("li#new-frag-li");
// <li> is now child of body, not fragment.
	$this->assertNull($fragLi);
	$this->assertNotNull($bodyLi);
	$this->assertEquals("inScope", $bodyLi->textContent);
}

public function testQuerySelectorAllAfterAddingToDocument() {
	$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

	$fragment = $document->createDocumentFragment();
	$fragment->appendXML("<ul><li id='new-frag-li'>inScope</li></ul>");

	$document->querySelector("span#replaceWithSUT")->replaceWith($fragment);

	$fragLiList = $fragment->querySelectorAll("li");
	$this->assertCount(0, $fragLiList);
}

public function testChildren() {
	$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

	$fragment = $document->createDocumentFragment();
	$fragment->appendXML("<p>one</p><p>two</p><p>three</p>");

	$this->assertCount(3, $fragment->children);
}

}#
