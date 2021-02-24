<?php
namespace Gt\Dom\Test;

use Gt\Dom\Element;
use Gt\Dom\HTMLDocument;
use Gt\Dom\Test\Helper\Helper;
use PHPUnit\Framework\TestCase;

class DocumentFragmentTest extends TestCase {
	private const DOC_CONTENT_BEFORE_INSERT = "<!doctype html><body>"
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

	public function testQuerySelectorBeforeAddingToDocument(): void
    {
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
		self::assertSame($expectedFirstLi, $actualFirstLi);
	}

	public function testQuerySelectorAllBeforeAddingToDocument(): void
    {
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
		self::assertCount($expectedCount, $liCollection);
	}

	public function testAppendsToDocument(): void
    {
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
		self::assertCount($expectedCount, $actualResult);
		self::assertSame($expectedFirstLi, $actualResult[0]);
	}

	public function testQuerySelectorAfterAddingToDocument(): void
    {
		$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

		$fragment = $document->createDocumentFragment();
		$fragment->appendXML("<ul><li id='new-frag-li'>inScope</li></ul>");

		$document->querySelector("span#replaceWithSUT")->replaceWith($fragment);

		$fragLi = $fragment->querySelector("li");
		$bodyLi = $document->querySelector("li#new-frag-li");
// <li> is now child of body, not fragment.
		self::assertNull($fragLi);
		self::assertNotNull($bodyLi);
		self::assertEquals("inScope", $bodyLi->textContent);
	}

	public function testQuerySelectorAllAfterAddingToDocument(): void
    {
		$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

		$fragment = $document->createDocumentFragment();
		$fragment->appendXML("<ul><li id='new-frag-li'>inScope</li></ul>");

		$document->querySelector("span#replaceWithSUT")->replaceWith($fragment);

		$fragLiList = $fragment->querySelectorAll("li");
		self::assertCount(0, $fragLiList);
	}

	public function testChildren(): void
    {
		$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

		$fragment = $document->createDocumentFragment();
		$fragment->appendXML("<p>one</p><p>two</p><p>three</p>");

		self::assertCount(3, $fragment->children);
	}

	public function testFirstElementChild(): void
    {
		$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

		$fragment = $document->createDocumentFragment();
		$fragment->appendXML("this is a text node<p>this is an element node</p>");
		$child = $fragment->firstElementChild;

		self::assertInstanceOf(Element::class, $child);
		self::assertEquals("p", $child->tagName);
	}

	public function testLastElementChild(): void
    {
		$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

		$fragment = $document->createDocumentFragment();
		$fragment->appendXML(
			"this is a text node"
			. "<p>this is a paragraph</p>"
			. "<div>this is a div</div>"
			. "this is another text node"
		);

		$child = $fragment->lastElementChild;

		self::assertInstanceOf(Element::class, $child);
		self::assertEquals("div", $child->tagName);
	}

	public function testGetChildElementCound(): void
    {
		$document = new HTMLDocument(self::DOC_CONTENT_BEFORE_INSERT);

		$fragment = $document->createDocumentFragment();
		$fragment->appendXML(
			"this is a text node"
			. "<p>this is a paragraph</p>"
			. "<div>this is a div</div>"
			. "this is another text node"
		);

		self::assertEquals(2, $fragment->childElementCount);
	}

	public function testTemplate(): void
    {
		$document = new HTMLDocument(Helper::DOCS_DOCUMENTFRAGMENT_PAGE);
		$fragment = $document->createDocumentFragment();
		$fragment->appendXML(Helper::DOCS_DOCUMENTFRAGMENT_TEMPLATE);

		$shopItemList = $document->querySelectorAll("shop-item");

		foreach($shopItemList as $shopItemElement) {
            // Create a clone of the fragment as a template element.
			$template = $fragment->cloneNode(true);
            // Set the elements of the fragment to their correct values.
			$link = $template->querySelector("a");
			$h1 = $template->querySelector("h1");
			$h2 = $template->querySelector("h2");

			$link->href .= $shopItemElement->id;
			$h1->textContent = $shopItemElement->getAttribute("name");
			$h2->textContent = $shopItemElement->getAttribute("price");
            // Replace the custom element with the contents of the fragment.
			$shopItemElement->replaceWith($template);

			self::assertNull($shopItemElement->parentNode);
		}

        // All shop-item elements should be replaced now.
		self::assertNull($document->querySelector("shop-item"));
	}

	public function testNoAttribute(): void
    {
		$document = new HTMLDocument(Helper::HTML_LESS);
		$fragment = $document->createDocumentFragment();
		$fragment->appendHTML(Helper::HTML_TEMPLATE_NO_ATTRIBUTE_VALUE);

		self::assertCount(1, $document->querySelectorAll("p"));
		$document->body->appendChild($fragment);
		self::assertCount(3,$document->querySelectorAll("p"));
	}

    /**
     * Tests the property innerHTML.
     * Checks that innerHTML is not null before it is attached to the DOM as well as that it is null
     * after.
     * @see https://developer.mozilla.org/en-US/docs/Web/API/DocumentFragment#Usage_notes
     */
	public function testInnerHTML():void {
        $document = new HTMLDocument(Helper::HTML);
        $fragment = $document->createDocumentFragment();

        self::assertNull($fragment->innerHTML);
        $fragment->appendHTML(Helper::HTML_TEXT);
        self::assertNotNull($fragment->innerHTML);
        $document->body->appendChild($fragment);
        self::assertNull($fragment->innerHTML);
    }
}