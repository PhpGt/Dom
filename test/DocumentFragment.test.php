<?php
namespace Gt\Dom;

class DocumentFragmentTest extends \PHPUnit_Framework_TestCase {

    const DOC_CONTENT_BEFORE_INSERT = "<!doctype html><body>"
    . "<div><ul><li>outOfScope</li></ul></div>"
    . "<span id='replaceWithSUT'></span>"
    . "<div><ul><li>outOfScope</li></ul></div>"
    . "</body>";

public function testQuerySelectorBeforeBeforeAddingToDocument() {
    $document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);
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

public function testQuerySelectorAllBeforeAddingToDocument() {
    $document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);
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
    $document = new HTMLDocument(
        self::DOC_CONTENT_BEFORE_INSERT);

    $fragment = $document->createDocumentFragment();
    $fragment->appendXML("<ul><li>inScope</li></ul>");

    $document->querySelector("span#replaceWithSUT")->replaceWith($fragment);

    $actualResult = $fragment->querySelector("li");
    $this->assertNotNull($actualResult);
    $this->assertEquals("inScope", $actualResult->textContent);
}

public function testQuerySelectorAllAfterAddingToDocument() {
    $document = new HTMLDocument(
        self::DOC_CONTENT_BEFORE_INSERT);

    $fragment = $document->createDocumentFragment();
    $fragment->appendXML("<ul><li>inScope</li></ul>");

    $document->querySelector("span#replaceWithSUT")->replaceWith($fragment);

    $actualResult = $fragment->querySelectorAll("li");
    $this->assertCount(1, $actualResult);
    $this->assertEquals("inScope", $actualResult[0]->textContent);
}

}#
